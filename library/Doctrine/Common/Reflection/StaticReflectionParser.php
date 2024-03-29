<?php

/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\Common\Reflection;

use ReflectionException;
use Doctrine\Common\Annotations\TokenParser;

/**
 * Parses a file for namespaces/use/class declarations.
 *
 * @author Karoly Negyesi <karoly@negyesi.net>
 */
class StaticReflectionParser implements ReflectionProviderInterface
{

    /**
     * The name of the class.
     *
     * @var string
     */
    protected $className;

    /**
     * TRUE if the caller only wants class annotations.
     *
     * @var boolean.
     */
    protected $classAnnotationOptimize;

    /**
     * TRUE when the parser has ran.
     *
     * @var boolean
     */
    protected $parsed = false;

    /**
     * The namespace of the class
     *
     * @var string
     */
    protected $namespace = '';

    /**
     * The use statements of this class.
     *
     * @var array
     */
    protected $useStatements = array();

    /**
     * The docComment of the class.
     *
     * @var string
     */
    protected $docComment = array(
        'class' => '',
        'property' => array(),
        'method' => array(),
    );

    /**
     * The name of the class this class extends, if any.
     *
     * @var string
     */
    protected $parentClassName = '';

    /**
     * The parent PSR-0 Parser.
     *
     * @var \Doctrine\Common\Annotations\StaticReflectionParser
     */
    protected $parentStaticReflectionParser;

    /**
     * Parses a class residing in a PSR-0 hierarchy.
     *
     * @param string $class
     *     The full, namespaced class name.
     * @param ClassFinder $finder
     *     A ClassFinder object which finds the class.
     * @param boolean $classAnnotationOptimize
     *     Only retrieve the class docComment. Presumes there is only one
     *     statement per line.
     */
    public function __construct($className, $finder, $classAnnotationOptimize = false)
    {
        $this->className = ltrim($className, '\\');
        if ($lastNsPos = strrpos($this->className, '\\')) {
            $this->namespace = substr($this->className, 0, $lastNsPos);
        }
        $this->finder = $finder;
        $this->classAnnotationOptimize = $classAnnotationOptimize;
    }

    protected function parse()
    {
        if ($this->parsed || !$fileName = $this->finder->findFile($this->className)) {
            return;
        }
        $this->parsed = true;
        $contents = file_get_contents($fileName);
        if ($this->classAnnotationOptimize) {
            if (preg_match("/(\A.*)^\s+(abstract|final)?\s+class\s+$className\s+{/sm", $contents, $matches)) {
                $contents = $matches[1];
            }
        }
        $tokenParser = new TokenParser($contents);
        $docComment = '';
        while ($token = $tokenParser->next(false)) {
            if (is_array($token)) {
                switch ($token[0]) {
                    case T_USE:
                        $this->useStatements = array_merge($this->useStatements, $tokenParser->parseUseStatement());
                        break;
                    case T_DOC_COMMENT:
                        $docComment = $token[1];
                        break;
                    case T_CLASS:
                        $this->docComment['class'] = $docComment;
                        $docComment = '';
                        break;
                    case T_VAR:
                    case T_PRIVATE:
                    case T_PROTECTED:
                    case T_PUBLIC:
                        $token = $tokenParser->next();
                        if ($token[0] === T_VARIABLE) {
                            $propertyName = substr($token[1], 1);
                            $this->docComment['property'][$propertyName] = $docComment;
                            continue 2;
                        }
                        if ($token[0] !== T_FUNCTION) {
                            // For example, it can be T_FINAL.
                            continue 2;
                        }
                    // No break.
                    case T_FUNCTION:
                        // The next string after function is the name, but
                        // there can be & before the function name so find the
                        // string.
                        while (($token = $tokenParser->next()) && $token[0] !== T_STRING);
                        $methodName = $token[1];
                        $this->docComment['method'][$methodName] = $docComment;
                        $docComment = '';
                        break;
                    case T_EXTENDS:
                        $this->parentClassName = $tokenParser->parseClass();
                        $nsPos = strpos($this->parentClassName, '\\');
                        $fullySpecified = false;
                        if ($nsPos === 0) {
                            $fullySpecified = true;
                        } else {
                            if ($nsPos) {
                                $prefix = strtolower(substr($this->parentClassName, 0, $nsPos));
                                $postfix = substr($this->parentClassName, $nsPos);
                            } else {
                                $prefix = strtolower($this->parentClassName);
                                $postfix = '';
                            }
                            foreach ($this->useStatements as $alias => $use) {
                                if ($alias == $prefix) {
                                    $this->parentClassName = '\\' . $use . $postfix;
                                    $fullySpecified = true;
                                }
                            }
                        }
                        if (!$fullySpecified) {
                            $this->parentClassName = '\\' . $this->namespace . '\\' . $this->parentClassName;
                        }
                        break;
                }
            }
        }
    }

    protected function getParentStaticReflectionParser()
    {
        if (empty($this->parentStaticReflectionParser)) {
            $this->parentStaticReflectionParser = new static($this->parentClassName, $this->finder);
        }

        return $this->parentStaticReflectionParser;
    }

    public function getClassName()
    {
        return $this->className;
    }

    public function getNamespaceName()
    {
        return $this->namespace;
    }

    /**
     * Get the ReflectionClass equivalent for this file / class.
     */
    public function getReflectionClass()
    {
        return new StaticReflectionClass($this);
    }

    /**
     * Get the ReflectionMethod equivalent for the method of this file / class.
     */
    public function getReflectionMethod($methodName)
    {
        return new StaticReflectionMethod($this, $methodName);
    }

    /**
     * Get the ReflectionProperty equivalent for the method of this file / class.
     */
    public function getReflectionProperty($propertyName)
    {
        return new StaticReflectionProperty($this, $propertyName);
    }

    /**
     * Get the use statements from this file.
     */
    public function getUseStatements()
    {
        $this->parse();

        return $this->useStatements;
    }

    /**
     * Get docComment.
     *
     * @param string $type class, property or method.
     * @param string $name Name of the property or method, not needed for class.
     *
     * @return string the doc comment or empty string if none.
     */
    public function getDocComment($type = 'class', $name = '')
    {
        $this->parse();

        return $name ? $this->docComment[$type][$name] : $this->docComment[$type];
    }

    /**
     * Get the PSR-0 parser for the declaring class.
     *
     * @param string $type property or method.
     * @param string $name Name of the property or method.
     *
     * @return StaticReflectionParser A static reflection parser for the declaring class.
     */
    public function getStaticReflectionParserForDeclaringClass($type, $name)
    {
        $this->parse();
        if (isset($this->docComment[$type][$name])) {
            return $this;
        }
        if (!empty($this->parentClassName)) {
            return $this->getParentStaticReflectionParser()->getStaticReflectionParserForDeclaringClass($type, $name);
        }
        throw new ReflectionException('Invalid ' . $type . ' "' . $name . '"');
    }

}

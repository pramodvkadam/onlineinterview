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

namespace Doctrine\ORM\Mapping\Builder;

/**
 * Field Builder
 *
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.doctrine-project.com
 * @since       2.2
 * @author      Benjamin Eberlei <kontakt@beberlei.de>
 */
class FieldBuilder
{

    /**
     * @var ClassMetadataBuilder
     */
    private $builder;

    /**
     * @var array
     */
    private $mapping;

    /**
     * @var bool
     */
    private $version;

    /**
     * @var string
     */
    private $generatedValue;

    /**
     * @var array
     */
    private $sequenceDef;

    /**
     *
     * @param ClassMetadataBuilder $builder
     * @param array $mapping
     */
    public function __construct(ClassMetadataBuilder $builder, array $mapping)
    {
        $this->builder = $builder;
        $this->mapping = $mapping;
    }

    /**
     * Set length.
     *
     * @param int $length
     * @return FieldBuilder
     */
    public function length($length)
    {
        $this->mapping['length'] = $length;
        return $this;
    }

    /**
     * Set nullable
     *
     * @param bool
     * @return FieldBuilder
     */
    public function nullable($flag = true)
    {
        $this->mapping['nullable'] = (bool) $flag;
        return $this;
    }

    /**
     * Set Unique
     *
     * @param bool
     * @return FieldBuilder
     */
    public function unique($flag = true)
    {
        $this->mapping['unique'] = (bool) $flag;
        return $this;
    }

    /**
     * Set column name
     *
     * @param string $name
     * @return FieldBuilder
     */
    public function columnName($name)
    {
        $this->mapping['columnName'] = $name;
        return $this;
    }

    /**
     * Set Precision
     *
     * @param  int $p
     * @return FieldBuilder
     */
    public function precision($p)
    {
        $this->mapping['precision'] = $p;
        return $this;
    }

    /**
     * Set scale.
     *
     * @param int $s
     * @return FieldBuilder
     */
    public function scale($s)
    {
        $this->mapping['scale'] = $s;
        return $this;
    }

    /**
     * Set field as primary key.
     *
     * @return FieldBuilder
     */
    public function isPrimaryKey()
    {
        $this->mapping['id'] = true;
        return $this;
    }

    /**
     * @param  int $strategy
     * @return FieldBuilder
     */
    public function generatedValue($strategy = 'AUTO')
    {
        $this->generatedValue = $strategy;
        return $this;
    }

    /**
     * Set field versioned
     *
     * @return FieldBuilder
     */
    public function isVersionField()
    {
        $this->version = true;
        return $this;
    }

    /**
     * Set Sequence Generator
     *
     * @param string $sequenceName
     * @param int $allocationSize
     * @param int $initialValue
     * @return FieldBuilder
     */
    public function setSequenceGenerator($sequenceName, $allocationSize = 1, $initialValue = 1)
    {
        $this->sequenceDef = array(
            'sequenceName' => $sequenceName,
            'allocationSize' => $allocationSize,
            'initialValue' => $initialValue,
        );
        return $this;
    }

    /**
     * Set column definition.
     *
     * @param string $def
     * @return FieldBuilder
     */
    public function columnDefinition($def)
    {
        $this->mapping['columnDefinition'] = $def;
        return $this;
    }

    /**
     * Finalize this field and attach it to the ClassMetadata.
     *
     * Without this call a FieldBuilder has no effect on the ClassMetadata.
     *
     * @return ClassMetadataBuilder
     */
    public function build()
    {
        $cm = $this->builder->getClassMetadata();
        if ($this->generatedValue) {
            $cm->setIdGeneratorType(constant('Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_' . $this->generatedValue));
        }
        if ($this->version) {
            $cm->setVersionMapping($this->mapping);
        }
        $cm->mapField($this->mapping);
        if ($this->sequenceDef) {
            $cm->setSequenceGeneratorDefinition($this->sequenceDef);
        }
        return $this->builder;
    }

}

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

namespace Doctrine\Common\Cache;

/**
 * Php file cache driver.
 *
 * @since   2.3
 * @author  Fabio B. Silva <fabio.bat.silva@gmail.com>
 */
class PhpFileCache extends FileCache
{
const EXTENSION = '.doctrinecache.php';

/**
 * {@inheritdoc}
 */
protected $extension = self::EXTENSION;

/**
 * {@inheritdoc}
 */
protected function doFetch($id)
{
$filename = $this->getFilename($id);

if (!file_exists($filename)) {
return false;
}

$value = include $filename;

if ($value['lifetime'] !== 0 && $value['lifetime'] < time()) {
return false;
}

return $value['data'];
}

/**
 * {@inheritdoc}
 */
protected function doContains($id)
{
$filename = $this->getFilename($id);

if (!file_exists($filename)) {
return false;
}

$value = include $filename;

return $value['lifetime'] === 0 || $value['lifetime'] > time();
}

/**
 * {@inheritdoc}
 */
protected function doSave($id, $data, $lifeTime = 0)
{
if ($lifeTime > 0) {
$lifeTime = time() + $lifeTime;
}

if (is_object($data) &&!method_exists($data, '__set_state')) {
throw new \InvalidArgumentException(
"Invalid argument given, PhpFileCache only allows objects that implement __set_state() " .
"and fully support var_export(). You can use the FilesystemCache to save arbitrary object " .
"graphs using serialize()/deserialize()."
);
}

$filename = $this->getFilename($id);
$filepath = pathinfo($filename, PATHINFO_DIRNAME);

if (!is_dir($filepath)) {
mkdir($filepath, 0777, true);
}

$value = array(
'lifetime' => $lifeTime,
 'data' => $data
);

$value = var_export($value, true);
$code = sprintf('<?php return %s;', $value);

return file_put_contents($filename, $code);
}
}

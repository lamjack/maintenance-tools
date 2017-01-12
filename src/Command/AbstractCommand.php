<?php
/**
 * AbstractCommand.php
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author    jack <linjue@wilead.com>
 * @copyright 2007-2017/1/12 WIZ TECHNOLOGY
 * @link      https://wizmacau.com
 * @link      https://lamjack.github.io
 * @link      https://github.com/lamjack
 * @version
 */
namespace Command;

use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class AbstractCommand
 * @package Command
 */
abstract class AbstractCommand extends BaseCommand
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);
        $this->container = $this->buildContainer();
    }

    /**
     * 查询命令路径
     *
     * @param string $bin
     * @return string
     * @throws \Exception
     */
    protected function whichBin($bin)
    {
        $path = exec(sprintf('which %s', $bin));
        if (empty($path))
            throw new \Exception(sprintf('%s 命令不存在', $bin));

        return $path;
    }

    /**
     * @return ContainerBuilder
     */
    private function buildContainer()
    {
        $container = new ContainerBuilder();

        // parameters
        $parameters = Yaml::parse(file_get_contents(PROJECT_ROOT . '/configs/configs.yml'));
        foreach ($parameters['configs'] as $k => $v) {
            $container->setParameter($k, $v);
        }

        return $container;
    }
}
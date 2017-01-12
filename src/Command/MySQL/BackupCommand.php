<?php
/**
 * BackupCommand.php
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
namespace Command\MySQL;

use Command\AbstractCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class BackupCommand
 * @package Command\MySQL
 */
class BackupCommand extends AbstractCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('mysql:backup')
            ->setDescription('MySQL数据库备份')
            ->addArgument('database', InputArgument::REQUIRED, '数据库名称')
            ->addArgument('backupPath', InputArgument::REQUIRED, '备份保存路径')
            ->addOption('maxFile', null, InputOption::VALUE_OPTIONAL, '备份文件最大数量,默认0,不限定数量', 0);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $mysqldumpBin = $this->whichBin('mysqldump');
        return 1;
    }
}
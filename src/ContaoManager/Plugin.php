<?php

namespace DieSchittigs\RecaptchaBundle\ContaoManager;

use DieSchittigs\RecaptchaBundle\RecaptchaBundle;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\CoreBundle\ContaoCoreBundle;

/**
 * @see https://github.com/contao/manager-plugin/blob/master/src/Bundle/BundlePluginInterface.php Code in GitHub
 */
class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(RecaptchaBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class])
        ];
    }
}

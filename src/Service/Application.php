<?php

namespace Lmh\WeChatPayV3\Service;

use Lmh\WeChatPayV3\Kernel\ServiceContainer;
use Lmh\WeChatPayV3\Service\Bill\Client;

/**
 * Class Application.
 *
 * @property \Lmh\WeChatPayV3\Service\Certificate\Client $certificate
 * @property \Lmh\WeChatPayV3\Service\Notify\Client $notify
 * @property \Lmh\WeChatPayV3\Service\Apply4Sub\SubMerchant\Client $subMerchant
 * @property \Lmh\WeChatPayV3\Service\Merchant\Media\Client $media
 * @property \Lmh\WeChatPayV3\Service\CombineTransaction\Client $combineTransaction
 * @property \Lmh\WeChatPayV3\Service\Ecommerce\Applyment\Client $applyment
 * @property \Lmh\WeChatPayV3\Service\Ecommerce\ProfitSharing\Order\Client $profitSharingOrder
 * @property \Lmh\WeChatPayV3\Service\Ecommerce\ProfitSharing\ReturnOrder\Client $profitSharingReturnOrder
 * @property \Lmh\WeChatPayV3\Service\Ecommerce\ProfitSharing\FinishOrder\Client $profitSharingFinishOrder
 * @property \Lmh\WeChatPayV3\Service\Ecommerce\Subsidy\Client $subsidy
 * @property \Lmh\WeChatPayV3\Service\Ecommerce\Refund\Client $refund
 * @property \Lmh\WeChatPayV3\Service\Ecommerce\Fund\Withdraw\Client $withdraw
 * @property \Lmh\WeChatPayV3\Service\Ecommerce\Fund\Balance\Client $balance
 * @property Client $bill
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Certificate\ServiceProvider::class,
        Notify\ServiceProvider::class,
        Apply4Sub\SubMerchant\ServiceProvider::class,
        Merchant\Media\ServiceProvider::class,
        CombineTransaction\ServiceProvider::class,
        Ecommerce\Applyment\ServiceProvider::class,
        Ecommerce\ProfitSharing\Order\ServiceProvider::class,
        Ecommerce\ProfitSharing\ReturnOrder\ServiceProvider::class,
        Ecommerce\ProfitSharing\FinishOrder\ServiceProvider::class,
        Ecommerce\Subsidy\ServiceProvider::class,
        Ecommerce\Refund\ServiceProvider::class,
        Ecommerce\Fund\Withdraw\ServiceProvider::class,
        Ecommerce\Fund\Balance\ServiceProvider::class,
        Bill\ServiceProvider::class,
    ];
}

<?php

namespace Lmh\WeChatPayV3\Service;

use Lmh\WeChatPayV3\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property Certificate\Client $certificate
 * @property Notify\Client $notify
 * @property Apply4Sub\SubMerchant\Client $subMerchant
 * @property Merchant\Media\Client $media
 * @property CombineTransaction\Client $combineTransaction
 * @property Ecommerce\Applyment\Client $applyment
 * @property Ecommerce\ProfitSharing\Order\Client $profitSharingOrder
 * @property Ecommerce\ProfitSharing\ReturnOrder\Client $profitSharingReturnOrder
 * @property Ecommerce\ProfitSharing\FinishOrder\Client $profitSharingFinishOrder
 * @property Ecommerce\ProfitSharing\Receiver\Client $profitSharingReceiver
 * @property Ecommerce\Subsidy\Client $subsidy
 * @property Ecommerce\Refund\Client $refund
 * @property Ecommerce\Fund\Withdraw\Client $withdraw
 * @property Ecommerce\Fund\Balance\Client $balance
 * @property Bill\Client $bill
 * @property Pay\Transaction\Client $transaction
 * @property Pay\Partner\Transaction\Client $partnerTransaction
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
        Ecommerce\ProfitSharing\Receiver\ServiceProvider::class,
        Ecommerce\Subsidy\ServiceProvider::class,
        Ecommerce\Refund\ServiceProvider::class,
        Ecommerce\Fund\Withdraw\ServiceProvider::class,
        Ecommerce\Fund\Balance\ServiceProvider::class,
        Bill\ServiceProvider::class,
        Pay\Transaction\ServiceProvider::class,
        Pay\Partner\Transaction\ServiceProvider::class,
    ];
}

<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/20 0020
 * Time: 11:16
 */

namespace KaiHeiLaSDK\Containers;


use KaiHeiLaSDK\Fetchers\GuzzleFetcher;
use KaiHeiLaSDK\Log\NullLogger;
use KaiHeiLaSDK\Traits\ConstructsContainers;
use KaiHeiLaSDK\Traits\ValidatesContainers;

class KHLConfiguration extends AbstractArrayAccess
{
    use ConstructsContainers,ValidatesContainers;

    /**
     * @var array
     */
    protected $data = [
        'http_user_agent'            => 'First Touch',

        'fetcher'                    => GuzzleFetcher::class,

        'token'                      => '',

        // Logging
        'logger'                     => NullLogger::class,
        'logger_level'               => 'info',
        'logfile_location'           => 'logs/',

        // Rotating Logger Details
        'log_max_files'              => 10,

    ];
}

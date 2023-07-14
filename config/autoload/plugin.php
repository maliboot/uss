<?php

declare(strict_types=1);
/**
 * This file is part of Maliboot.
 *
 * @link     https://github.com/maliboot
 * @document https://github.com/maliboot
 */
use MaliBoot\PluginCodeGenerator\Client\Constants\FileType;

return [
    'paths' => [
        'base_path' => BASE_PATH . '/module',
        'generator' => [
            FileType::ROOT => ['path' => 'src', 'generate' => true, 'gitignore' => false],
            FileType::ADAPTER => ['path' => 'src/Adapter', 'generate' => true, 'gitignore' => false],
            FileType::ADAPTER_CONSOLE => ['path' => 'src/Adapter/Console', 'generate' => true, 'gitignore' => true],
            FileType::ADAPTER_SUBSCRIBER => ['path' => 'src/Adapter/Subscriber', 'generate' => true, 'gitignore' => true],
            FileType::ADAPTER_RPC => ['path' => 'src/Adapter/Rpc', 'generate' => true, 'gitignore' => true],
            FileType::ADAPTER_ADMIN => ['path' => 'src/Adapter/Admin', 'generate' => true, 'gitignore' => true],
            FileType::ADAPTER_MOBILE => ['path' => 'src/Adapter/Mobile', 'generate' => true, 'gitignore' => true],
            FileType::ADAPTER_WAP => ['path' => 'src/Adapter/Wap', 'generate' => false, 'gitignore' => true],
            FileType::ADAPTER_WEB => ['path' => 'src/Adapter/Web', 'generate' => false, 'gitignore' => true],
            FileType::ADAPTER_PDA => ['path' => 'src/Adapter/Pda', 'generate' => true, 'gitignore' => true],
            FileType::APP => ['path' => 'src/App', 'generate' => true, 'gitignore' => true],
            FileType::APP_EVENT => ['path' => 'src/App/Consumer', 'generate' => true, 'gitignore' => true],
            FileType::APP_EXECUTOR => ['path' => 'src/App/Executor', 'generate' => true, 'gitignore' => false],
            FileType::APP_EXECUTOR_COMMAND => ['path' => 'src/App/Executor/Command', 'generate' => true, 'gitignore' => false],
            FileType::APP_EXECUTOR_COMMAND_ADMIN => ['path' => 'src/App/Executor/Command/Admin', 'generate' => true, 'gitignore' => true],
            FileType::APP_EXECUTOR_COMMAND_MOBILE => ['path' => 'src/App/Executor/Command/Mobile', 'generate' => false, 'gitignore' => true],
            FileType::APP_EXECUTOR_COMMAND_WAP => ['path' => 'src/App/Executor/Command/Wap', 'generate' => false, 'gitignore' => true],
            FileType::APP_EXECUTOR_COMMAND_WEB => ['path' => 'src/App/Executor/Command/Web', 'generate' => false, 'gitignore' => true],
            FileType::APP_EXECUTOR_QUERY => ['path' => 'src/App/Executor/Query', 'generate' => true, 'gitignore' => false],
            FileType::APP_EXECUTOR_QUERY_ADMIN => ['path' => 'src/App/Executor/Query/Admin', 'generate' => true, 'gitignore' => true],
            FileType::APP_EXECUTOR_QUERY_MOBILE => ['path' => 'src/App/Executor/Query/Mobile', 'generate' => false, 'gitignore' => true],
            FileType::APP_EXECUTOR_QUERY_WAP => ['path' => 'src/App/Executor/Query/Wap', 'generate' => false, 'gitignore' => true],
            FileType::APP_EXECUTOR_QUERY_WEB => ['path' => 'src/App/Executor/Query/Web', 'generate' => false, 'gitignore' => true],
            FileType::CLIENT => ['path' => 'src/Client', 'generate' => true, 'gitignore' => false],
            FileType::CLIENT_API => ['path' => 'src/Client/Api', 'generate' => true, 'gitignore' => true],
            FileType::CLIENT_DTO => ['path' => 'src/Client/Dto', 'generate' => true, 'gitignore' => false],
            FileType::CLIENT_DTO_COMMAND => ['path' => 'src/Client/Dto/Command', 'generate' => true, 'gitignore' => true],
            FileType::CLIENT_DTO_QUERY => ['path' => 'src/Client/Dto/Query', 'generate' => true, 'gitignore' => true],
            FileType::CLIENT_VIEW_OBJECT => ['path' => 'src/Client/ViewObject', 'generate' => true, 'gitignore' => true],
            FileType::CLIENT_EVENT => ['path' => 'src/Client/Event', 'generate' => true, 'gitignore' => true],
            FileType::DOMAIN => ['path' => 'src/Domain', 'generate' => true, 'gitignore' => false],
            FileType::DOMAIN_MODEL => ['path' => 'src/Domain/Model', 'generate' => true, 'gitignore' => false],
            FileType::DOMAIN_SERVICE => ['path' => 'src/Domain/Service', 'generate' => true, 'gitignore' => true],
            FileType::DOMAIN_REPOSITORY => ['path' => 'src/Domain/Repository', 'generate' => true, 'gitignore' => true],
            FileType::QUERY => ['path' => 'src/Query', 'generate' => true, 'gitignore' => true],
            FileType::INFRA => ['path' => 'src/Infra', 'generate' => true, 'gitignore' => false],
            FileType::INFRA_REPOSITORY => ['path' => 'src/Infra/Repository', 'generate' => true, 'gitignore' => true],
            FileType::INFRA_DATA_OBJECT => ['path' => 'src/Infra/DataObject', 'generate' => true, 'gitignore' => true],
        ],
    ],
    'copyright' => <<< 'COPYRIGHT'
/**
 * This file is part of maliboot module.
 *
 * @link     https://github.com/maliboot
 */
COPYRIGHT,
    'composer' => [
        'username' => 'module',
        'namespace_prefix' => 'Module',
    ],
];

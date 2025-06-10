<?php

/**
 * The file is part of the "webifycms/ext-user", WebifyCMS extension package.
 *
 * @see https://webifycms.com/extension/user
 *
 * @copyright Copyright (c) 2023 WebifyCMS
 * @license https://webifycms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

// should require the composer autoloader on first
require __DIR__ . '/vendor/autoload.php';

use PhpCsFixer\Finder;
use Webify\Tools\Fixer\Fixer;

$finder = Finder::create()
	->in(__DIR__)
	->exclude(
		[
			'vendor',
		]
	)
	->ignoreDotFiles(false)
	->name('*.php')
;
$header = <<<'HEADER'
	The file is part of the "webifycms/ext-user", WebifyCMS extension package.

	@see https://webifycms.com/extension/user

	@copyright Copyright (c) 2023 WebifyCMS
	@license https://webifycms.com/extension/user/license
	@author Mohammed Shifreen <mshifreen@gmail.com>
	HEADER;
$rules = [
	'echo_tag_syntax' => [
		'format'                         => 'short',
		'shorten_simple_statements_only' => false,
	],
	'phpdoc_to_comment'       => false,
	'global_namespace_import' => [
		'import_classes'   => true,
		'import_constants' => false,
		'import_functions' => true,
	],
	'header_comment' => [
		'header'       => $header,
		'location'     => 'after_open',
		'comment_type' => 'PHPDoc',
		'separate'     => 'top',
	],
	'no_alternative_syntax' => [
		'fix_non_monolithic_code' => false,
	],
];

return (new Fixer($finder, $rules))
	->getConfig()
	->setUsingCache(false)
;

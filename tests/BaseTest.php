<?php
/**
 * Created by PhpStorm.
 * User: pkly
 * Date: 27.09.2019
 * Time: 14:15
 */

namespace Pkly\I18Next\Tests;

use PHPUnit\Framework\TestCase;
use Pkly\I18Next\I18n;

class BaseTest extends TestCase {
    public function testCIMode() {
        $i18n = new I18n([
            'lng'           =>  'cimode',
            'debug'         =>  true
        ]);

        $this->assertEquals('test.key', $i18n->t('test.key'));

        $i18nWithCiModeNamespace = new I18n([
            'lng'           =>  'cimode',
            'debug'         =>  true,
            'appendNamespaceToCIMode'   =>  true
        ]);

        $this->assertEquals('translation:test.key', $i18nWithCiModeNamespace->t('test.key'));
    }

    /**
     * @depends testCIMode
     */
    public function testNormalUsage() {
        $i18n = new I18n([
            'lng'           =>  'en',
            'debug'         =>  true,
            'resources'     =>  [
                'en'        =>  [
                    'translation'       =>  [
                        'key'           =>  'value',
                        'deep'          =>  [
                            'key'       =>  'value2'
                        ]
                    ]
                ]
            ]
        ]);

        $this->assertEquals('value', $i18n->t('key'));
        $this->assertEquals('value2', $i18n->t('deep.key'));
    }
}
<?php

require_once dirname(__FILE__) . '/../../MultiLanguageStudio.php';

require_once dirname(__FILE__) . '/../../../../cred.php';

$setting = <<<json
{
  "connection":{
    "uri": "http://langrid.org/service_manager/wsdl/{service_id}",
    "userId": "{$cred['user']}",
    "passwd": "{$cred['pass']}"
  },
  "serviceSetting": {
    "collection": [
      {
        "path":"ja=>en",
        "serviceId":"kyoto1.langrid:TwoHopTranslation",
        "binding":
        [
          {
            "invocationName":"SecondTranslationPL",
            "serviceId":"kyoto1.langrid:KyotoUJServer"
          },
          {
            "invocationName":"FirstTranslationPL",
            "serviceId":"kyoto1.langrid:KyotoUJServer"
          }
        ]
      },
      {
        "path":"en=>ja",
        "serviceId":"kyoto1.langrid:TwoHopTranslation",
        "binding":
        [
          {
            "invocationName":"SecondTranslationPL",
            "serviceId":"kyoto1.langrid:KyotoUJServer"
          },
          {
            "invocationName":"FirstTranslationPL",
            "serviceId":"kyoto1.langrid:KyotoUJServer"
          }
        ]
      },
      {
        "path":"ja=>ko",
        "serviceId":"kyoto1.langrid:TwoHopTranslation",
        "binding":
        [
          {
            "invocationName":"SecondTranslationPL",
            "serviceId":"kyoto1.langrid:KyotoUJServer"
          },
          {
            "invocationName":"FirstTranslationPL",
            "serviceId":"kyoto1.langrid:KyotoUJServer"
          }
        ]
      },
      {
        "path":"ko=>ja",
        "serviceId":"kyoto1.langrid:TwoHopTranslation",
        "binding":
        [
          {
            "invocationName":"SecondTranslationPL",
            "serviceId":"kyoto1.langrid:KyotoUJServer"
          },
          {
            "invocationName":"FirstTranslationPL",
            "serviceId":"kyoto1.langrid:KyotoUJServer"
          }
        ]
      },
      {
        "path":"ja=>fr",
        "serviceId":"kyoto1.langrid:TwoHopTranslation",
        "binding":
        [
          {
            "invocationName":"SecondTranslationPL",
            "serviceId":"kyoto1.langrid:GoogleTranslate"
          },
          {
            "invocationName":"FirstTranslationPL",
            "serviceId":"kyoto1.langrid:GoogleTranslate"
          }
        ]
      },
      {
        "path":"fr=>ja",
        "serviceId":"kyoto1.langrid:TwoHopTranslation",
        "binding":
        [
          {
            "invocationName":"SecondTranslationPL",
            "serviceId":"kyoto1.langrid:GoogleTranslate"
          },
          {
            "invocationName":"FirstTranslationPL",
            "serviceId":"kyoto1.langrid:GoogleTranslate"
          }
        ]
      }
    ]
  }
}
json
    ;

$setting3hop = <<<json
{
  "connection":{
    "uri": "http://langrid.org/service_manager/wsdl/{service_id}",
    "userId": "",
    "passwd": ""
  },
  "serviceSetting": {
    "collection": [
      {
        "path":"ja=>en",
        "serviceId":"kyoto1.langrid:ThreeHopTranslation",
        "binding":
        [
          {
            "invocationName":"SecondTranslationPL",
            "serviceId":"kyoto1.langrid:KyotoUJServer"
          },
          {
            "invocationName":"FirstTranslationPL",
            "serviceId":"kyoto1.langrid:KyotoUJServer"
          },
          {
            "invocationName":"ThirdTranslationPL",
            "serviceId":"kyoto1.langrid:KyotoUJServer"
          }
        ]
      },
      {
        "path":"en=>ja",
        "serviceId":"kyoto1.langrid:ThreeHopTranslation",
        "binding":
        [
          {
            "invocationName":"SecondTranslationPL",
            "serviceId":"kyoto1.langrid:KyotoUJServer"
          },
          {
            "invocationName":"FirstTranslationPL",
            "serviceId":"kyoto1.langrid:KyotoUJServer"
          },
          {
            "invocationName":"ThirdTranslationPL",
            "serviceId":"kyoto1.langrid:KyotoUJServer"
          }
        ]
      }
    ]
  }
}
json
    ;


$obj = new MultihopTranslationConfigurator(json_decode($setting));
//$obj = new MultihopTranslationConfigurator(json_decode($setting3hop));

$cli = $obj->createClient('ja', 'en', 'fr');
//$cli = $obj->createClient('ja', 'ko', 'fr');

//print_r($cli);

try {
    print_r($cli->multihopTranslate(Language::get('ja'), array(Language::get('en')), Language::get('ja'), 'こんにちは'));
    //print_r($cli ->multihopTranslate(Language::get('ja'), array(Language::get('ko')), Language::get('fr'), '私はリンゴが好きです'));
    print("EOF");
} catch (Exception $e) {
    print_r($e);
}

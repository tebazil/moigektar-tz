<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

Yii::setAlias('@tests', __DIR__);

const API_JSON_RESPONSE_ERROR_BODY_EXAMPLE = /** @lang JSON */ <<<JSON1
{
  "name": "Model is invalid",
  "message": "Model Common\\DTO\\PlotsCollection is invalid:\n[\n    \"plots[0]: [\\\"Значение «Кадастровый номер» неверно.\\\"]\"\n]",
  "code": 0,
  "status": 400
}
JSON1;

const API_JSON_RESPONSE_OK_BODY_EXAMPLE = /** @lang JSON */ <<<JSON2
[
  {
    "id": "69:27:22:1306",
    "number": "69:27:0000022:1306",
    "attrs": {
      "plot_id": "69:27:22:1306",
      "plot_area": 10035,
      "plot_price": 36126,
      "plot_number": "69:27:0000022:1306",
      "plot_address": "Тверская область, р-н Ржевский, с/пос \"Успенское\", северо-западнее д. Горшково из земель СПКколхоз \"Мирный\"",
      "category_code": "003001000000",
      "category_name": "Земли сельскохозяйственного назначения",
      "plot_area_inaccuracy": 877,
      "permitted_use_document_name": "Для ведения сельского хозяйства",
      "permitted_use_classifier_code": null,
      "permitted_use_classifier_name": null
    },
    "extent": {
      "srs": "EPSG:4326",
      "xmax": 34.44995279601164,
      "xmin": 34.44712834168332,
      "ymax": 56.24083383325534,
      "ymin": 56.239494097315074,
      "width": 0.002824454328319348,
      "height": 0.0013397359402631537
    },
    "center": {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          34.44854056884748,
          56.240163965285205
        ]
      },
      "crs": {
        "type": "name",
        "properties": {
          "name": "urn:ogc:def:crs:OGC:1.3:CRS84"
        }
      }
    },
    "spatial": {
      "type": "Feature",
      "geometry": {
        "type": "MultiPolygon",
        "coordinates": [
          [
            [
              [
                34.44712834168332,
                56.239718149068004
              ],
              [
                34.44733979957994,
                56.24005807532368
              ],
              [
                34.447995673621364,
                56.24003698058185
              ],
              [
                34.44862680062543,
                56.23990484310517
              ],
              [
                34.44906451232455,
                56.23998322970651
              ],
              [
                34.449241939342016,
                56.24044349025819
              ],
              [
                34.44941448073057,
                56.24083383325533
              ],
              [
                34.44995279601164,
                56.240818391902216
              ],
              [
                34.449559130042836,
                56.239494097315074
              ]
            ]
          ]
        ]
      },
      "crs": {
        "type": "name",
        "properties": {
          "name": "urn:ogc:def:crs:OGC:1.3:CRS84"
        }
      }
    },
    "created_at": "2021-02-01T17:16:47+03:00",
    "updated_at": "2022-12-26T21:09:14+03:00",
    "_links": {
      "pkk": {
        "attrs": {
          "href": null
        },
        "search": {
          "href": null
        },
        "related": {
          "href": null
        }
      }
    }
  },
  {
    "id": "69:27:22:1307",
    "number": "69:27:0000022:1307",
    "attrs": {
      "plot_id": "69:27:22:1307",
      "plot_area": 10176,
      "plot_price": 36633.6,
      "plot_number": "69:27:0000022:1307",
      "plot_address": "Тверская область, р-н Ржевский, с/пос \"Успенское\", северо-западнее д. Горшково из земель СПКколхоз \"Мирный\"",
      "category_code": "003001000000",
      "category_name": "Земли сельскохозяйственного назначения",
      "plot_area_inaccuracy": 883,
      "permitted_use_document_name": "Для ведения сельского хозяйства",
      "permitted_use_classifier_code": null,
      "permitted_use_classifier_name": null
    },
    "extent": {
      "srs": "EPSG:4326",
      "xmax": 34.449559130042836,
      "xmin": 34.44684438158197,
      "ymax": 56.239718149068004,
      "ymin": 56.23892018871071,
      "width": 0.002714748460867611,
      "height": 0.0007979603572962901
    },
    "center": {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          34.448201755812406,
          56.23931916888935
        ]
      },
      "crs": {
        "type": "name",
        "properties": {
          "name": "urn:ogc:def:crs:OGC:1.3:CRS84"
        }
      }
    },
    "spatial": {
      "type": "Feature",
      "geometry": {
        "type": "MultiPolygon",
        "coordinates": [
          [
            [
              [
                34.44712834168332,
                56.239718149068004
              ],
              [
                34.449559130042836,
                56.239494097315074
              ],
              [
                34.449388637015595,
                56.23892018871071
              ],
              [
                34.44684438158197,
                56.2391546929358
              ],
              [
                34.44699617722965,
                56.23950588578719
              ]
            ]
          ]
        ]
      },
      "crs": {
        "type": "name",
        "properties": {
          "name": "urn:ogc:def:crs:OGC:1.3:CRS84"
        }
      }
    },
    "created_at": "2021-02-01T17:16:47+03:00",
    "updated_at": "2022-12-26T21:09:14+03:00",
    "_links": {
      "pkk": {
        "attrs": {
          "href": null
        },
        "search": {
          "href": null
        },
        "related": {
          "href": null
        }
      }
    }
  }
]
JSON2;


new \yii\console\Application([
    'id' => 'test-app-id',
    'basePath' => __DIR__,
]);
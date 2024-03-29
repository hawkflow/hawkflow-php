<?php

namespace HawkFlow\HawkFlow\Tests;

use HawkFlow\HawkFlow\HawkFlowException;
use HawkFlow\HawkFlow\Validation;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{
    /** @test */
    public function validate_api_key_valid()
    {
        $this->expectNotToPerformAssertions();

        Validation::validateApiKey('api _ KEY   -123');
    }

    /** @test */
    public function validate_api_key_empty()
    {
        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^No API Key set\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateApiKey('');
    }

    /** @test */
    public function validate_api_key_too_long()
    {
        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^Invalid API Key format\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateApiKey('________10________20________30________40________50x');
    }

    /** @test */
    public function validate_api_key_format()
    {
        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^Invalid API Key format\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateApiKey('invalid api key ❌');
    }

    /** @test */
    public function validate_timed_data_valid()
    {
        $process = 'process_name';
        $meta = '';
        $uid = '';

        $this->expectNotToPerformAssertions();

        Validation::validateTimedData($process, $meta, $uid);
    }

    /** @test */
    public function validate_timed_data_valid_with_meta()
    {
        $process = 'process_name';
        $meta = 'meta_data';
        $uid = '';

        $this->expectNotToPerformAssertions();

        Validation::validateTimedData($process, $meta, $uid);
    }

    /** @test */
    public function validate_timed_data_valid_with_uid()
    {
        $process = 'process_name';
        $meta = '';
        $uid = 'uid';

        $this->expectNotToPerformAssertions();

        Validation::validateTimedData($process, $meta, $uid);
    }

    /** @test */
    public function validate_timed_data_valid_with_meta_uid()
    {
        $process = 'process_name';
        $meta = 'meta_data';
        $uid = 'uid';

        $this->expectNotToPerformAssertions();

        Validation::validateTimedData($process, $meta, $uid);
    }

    /** @test */
    public function validate_timed_data_ivalid_missing_process()
    {
        $process = '';
        $meta = '';
        $uid = '';

        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^No process set\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateTimedData($process, $meta, $uid);
    }

    /** @test */
    public function validate_exception_valid()
    {
        $message = 'exception message';
        $process = 'process_name';
        $meta = '';

        $this->expectNotToPerformAssertions();

        Validation::validateException($message, $process, $meta);
    }

    /** @test */
    public function validate_exception_valid_with_meta()
    {
        $message = 'exception message';
        $process = 'process_name';
        $meta = 'meta_data';

        $this->expectNotToPerformAssertions();

        Validation::validateException($message, $process, $meta);
    }

    /** @test */
    public function validate_exception_valid_without_message()
    {
        $message = '';
        $process = 'process_name';
        $meta = '';

        $this->expectNotToPerformAssertions();

        Validation::validateException($message, $process, $meta);
    }

    /** @test */
    public function validate_exception_invalid_missing_process()
    {
        $message = 'exception message';
        $process = '';
        $meta = '';

        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^No process set\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateException($message, $process, $meta);
    }

    /** @test */
    public function validate_metrics_valid()
    {
        $items = ['key' => 123];
        $process = 'process_name';
        $meta = '';

        $this->expectNotToPerformAssertions();

        Validation::validateMetrics($items, $process, $meta);
    }

    /** @test */
    public function validate_metrics_valid_with_meta()
    {
        $items = ['key' => 123];
        $process = 'process_name';
        $meta = 'meta_data';

        $this->expectNotToPerformAssertions();

        Validation::validateMetrics($items, $process, $meta);
    }

    /** @test */
    public function validate_metrics_invalid_without_process()
    {
        $items = ['key' => 123];
        $process = '';
        $meta = '';

        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^No process set\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateMetrics($items, $process, $meta);
    }

    /** @test */
    public function validate_metrics_invalid_without_items()
    {
        $items = [];
        $process = 'process_name';
        $meta = '';

        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^No items set\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateMetrics($items, $process, $meta);
    }

    /** @test */
    public function validate_metrics_invalid_long_key()
    {
        $items = ['________10________20________30________40________50x' => 123];
        $process = 'process_name';
        $meta = '';

        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^Item key ________10________20________30________40________50x exceeded max length of 50 characters\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateMetrics($items, $process, $meta);
    }

    /** @test */
    public function validate_process_valid()
    {
        $this->expectNotToPerformAssertions();

        Validation::validateProcess('process _ Name   -123');
    }

    /** @test */
    public function validate_process_empty()
    {
        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^No process set\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateProcess('');
    }

    /** @test */
    public function validate_process_too_long()
    {
        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^Process parameter exceeded max length of 250 characters\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateProcess('________10________20________30________40________50________60________70________80________90_______100_______110_______120_______130_______140_______150_______160_______170_______180_______190_______200_______210_______220_______230_______240_______250x');
    }

    /** @test */
    public function validate_process_format()
    {
        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^Process parameter contains unsupported characters\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateProcess('invalid process ❌');
    }

    /** @test */
    public function validate_meta_valid()
    {
        $this->expectNotToPerformAssertions();

        Validation::validateMeta('meta _ Data   -123');
    }

    /** @test */
    public function validate_meta_empty()
    {
        $this->expectNotToPerformAssertions();

        Validation::validateMeta('');
    }

    /** @test */
    public function validate_meta_too_long()
    {
        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^Meta parameter exceeded max length of 500 characters\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateMeta('________10________20________30________40________50________60________70________80________90_______100_______110_______120_______130_______140_______150_______160_______170_______180_______190_______200_______210_______220_______230_______240_______250_______260_______270_______280_______290_______300_______310_______320_______330_______340_______350_______360_______370_______380_______390_______400_______410_______420_______430_______440_______450_______460_______470_______480_______490_______500x');
    }

    /** @test */
    public function validate_meta_format()
    {
        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^Meta parameter contains unsupported characters\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateMeta('invalid meta ❌');
    }

    /** @test */
    public function validate_uid_valid()
    {
        $this->expectNotToPerformAssertions();

        Validation::validateUID('uid _ UID   -123');
    }

    /** @test */
    public function validate_uid_empty()
    {
        $this->expectNotToPerformAssertions();

        Validation::validateUID('');
    }

    /** @test */
    public function validate_uid_too_long()
    {
        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^UID parameter exceeded max length of 50 characters\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateUID('________10________20________30________40________50x');
    }

    /** @test */
    public function validate_uid_format()
    {
        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^UID parameter contains unsupported characters\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateUID('invalid uid ❌');
    }

    /** @test */
    public function validate_exception_message_valid()
    {
        $this->expectNotToPerformAssertions();

        Validation::validateExceptionMessage('exception _ Message   -123 ✅');
    }

    /** @test */
    public function validate_exception_message_empty()
    {
        $this->expectNotToPerformAssertions();

        Validation::validateExceptionMessage('');
    }

    /** @test */
    public function validate_exception_message_too_long()
    {
        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^ExceptionMessage parameter exceeded max length of 15000 characters\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateExceptionMessage('________10________20________30________40________50________60________70________80________90_______100_______110_______120_______130_______140_______150_______160_______170_______180_______190_______200_______210_______220_______230_______240_______250_______260_______270_______280_______290_______300_______310_______320_______330_______340_______350_______360_______370_______380_______390_______400_______410_______420_______430_______440_______450_______460_______470_______480_______490_______500_______510_______520_______530_______540_______550_______560_______570_______580_______590_______600_______610_______620_______630_______640_______650_______660_______670_______680_______690_______700_______710_______720_______730_______740_______750_______760_______770_______780_______790_______800_______810_______820_______830_______840_______850_______860_______870_______880_______890_______900_______910_______920_______930_______940_______950_______960_______970_______980_______990______1000______1010______1020______1030______1040______1050______1060______1070______1080______1090______1100______1110______1120______1130______1140______1150______1160______1170______1180______1190______1200______1210______1220______1230______1240______1250______1260______1270______1280______1290______1300______1310______1320______1330______1340______1350______1360______1370______1380______1390______1400______1410______1420______1430______1440______1450______1460______1470______1480______1490______1500______1510______1520______1530______1540______1550______1560______1570______1580______1590______1600______1610______1620______1630______1640______1650______1660______1670______1680______1690______1700______1710______1720______1730______1740______1750______1760______1770______1780______1790______1800______1810______1820______1830______1840______1850______1860______1870______1880______1890______1900______1910______1920______1930______1940______1950______1960______1970______1980______1990______2000______2010______2020______2030______2040______2050______2060______2070______2080______2090______2100______2110______2120______2130______2140______2150______2160______2170______2180______2190______2200______2210______2220______2230______2240______2250______2260______2270______2280______2290______2300______2310______2320______2330______2340______2350______2360______2370______2380______2390______2400______2410______2420______2430______2440______2450______2460______2470______2480______2490______2500______2510______2520______2530______2540______2550______2560______2570______2580______2590______2600______2610______2620______2630______2640______2650______2660______2670______2680______2690______2700______2710______2720______2730______2740______2750______2760______2770______2780______2790______2800______2810______2820______2830______2840______2850______2860______2870______2880______2890______2900______2910______2920______2930______2940______2950______2960______2970______2980______2990______3000______3010______3020______3030______3040______3050______3060______3070______3080______3090______3100______3110______3120______3130______3140______3150______3160______3170______3180______3190______3200______3210______3220______3230______3240______3250______3260______3270______3280______3290______3300______3310______3320______3330______3340______3350______3360______3370______3380______3390______3400______3410______3420______3430______3440______3450______3460______3470______3480______3490______3500______3510______3520______3530______3540______3550______3560______3570______3580______3590______3600______3610______3620______3630______3640______3650______3660______3670______3680______3690______3700______3710______3720______3730______3740______3750______3760______3770______3780______3790______3800______3810______3820______3830______3840______3850______3860______3870______3880______3890______3900______3910______3920______3930______3940______3950______3960______3970______3980______3990______4000______4010______4020______4030______4040______4050______4060______4070______4080______4090______4100______4110______4120______4130______4140______4150______4160______4170______4180______4190______4200______4210______4220______4230______4240______4250______4260______4270______4280______4290______4300______4310______4320______4330______4340______4350______4360______4370______4380______4390______4400______4410______4420______4430______4440______4450______4460______4470______4480______4490______4500______4510______4520______4530______4540______4550______4560______4570______4580______4590______4600______4610______4620______4630______4640______4650______4660______4670______4680______4690______4700______4710______4720______4730______4740______4750______4760______4770______4780______4790______4800______4810______4820______4830______4840______4850______4860______4870______4880______4890______4900______4910______4920______4930______4940______4950______4960______4970______4980______4990______5000______5010______5020______5030______5040______5050______5060______5070______5080______5090______5100______5110______5120______5130______5140______5150______5160______5170______5180______5190______5200______5210______5220______5230______5240______5250______5260______5270______5280______5290______5300______5310______5320______5330______5340______5350______5360______5370______5380______5390______5400______5410______5420______5430______5440______5450______5460______5470______5480______5490______5500______5510______5520______5530______5540______5550______5560______5570______5580______5590______5600______5610______5620______5630______5640______5650______5660______5670______5680______5690______5700______5710______5720______5730______5740______5750______5760______5770______5780______5790______5800______5810______5820______5830______5840______5850______5860______5870______5880______5890______5900______5910______5920______5930______5940______5950______5960______5970______5980______5990______6000______6010______6020______6030______6040______6050______6060______6070______6080______6090______6100______6110______6120______6130______6140______6150______6160______6170______6180______6190______6200______6210______6220______6230______6240______6250______6260______6270______6280______6290______6300______6310______6320______6330______6340______6350______6360______6370______6380______6390______6400______6410______6420______6430______6440______6450______6460______6470______6480______6490______6500______6510______6520______6530______6540______6550______6560______6570______6580______6590______6600______6610______6620______6630______6640______6650______6660______6670______6680______6690______6700______6710______6720______6730______6740______6750______6760______6770______6780______6790______6800______6810______6820______6830______6840______6850______6860______6870______6880______6890______6900______6910______6920______6930______6940______6950______6960______6970______6980______6990______7000______7010______7020______7030______7040______7050______7060______7070______7080______7090______7100______7110______7120______7130______7140______7150______7160______7170______7180______7190______7200______7210______7220______7230______7240______7250______7260______7270______7280______7290______7300______7310______7320______7330______7340______7350______7360______7370______7380______7390______7400______7410______7420______7430______7440______7450______7460______7470______7480______7490______7500______7510______7520______7530______7540______7550______7560______7570______7580______7590______7600______7610______7620______7630______7640______7650______7660______7670______7680______7690______7700______7710______7720______7730______7740______7750______7760______7770______7780______7790______7800______7810______7820______7830______7840______7850______7860______7870______7880______7890______7900______7910______7920______7930______7940______7950______7960______7970______7980______7990______8000______8010______8020______8030______8040______8050______8060______8070______8080______8090______8100______8110______8120______8130______8140______8150______8160______8170______8180______8190______8200______8210______8220______8230______8240______8250______8260______8270______8280______8290______8300______8310______8320______8330______8340______8350______8360______8370______8380______8390______8400______8410______8420______8430______8440______8450______8460______8470______8480______8490______8500______8510______8520______8530______8540______8550______8560______8570______8580______8590______8600______8610______8620______8630______8640______8650______8660______8670______8680______8690______8700______8710______8720______8730______8740______8750______8760______8770______8780______8790______8800______8810______8820______8830______8840______8850______8860______8870______8880______8890______8900______8910______8920______8930______8940______8950______8960______8970______8980______8990______9000______9010______9020______9030______9040______9050______9060______9070______9080______9090______9100______9110______9120______9130______9140______9150______9160______9170______9180______9190______9200______9210______9220______9230______9240______9250______9260______9270______9280______9290______9300______9310______9320______9330______9340______9350______9360______9370______9380______9390______9400______9410______9420______9430______9440______9450______9460______9470______9480______9490______9500______9510______9520______9530______9540______9550______9560______9570______9580______9590______9600______9610______9620______9630______9640______9650______9660______9670______9680______9690______9700______9710______9720______9730______9740______9750______9760______9770______9780______9790______9800______9810______9820______9830______9840______9850______9860______9870______9880______9890______9900______9910______9920______9930______9940______9950______9960______9970______9980______9990_____10000_____10010_____10020_____10030_____10040_____10050_____10060_____10070_____10080_____10090_____10100_____10110_____10120_____10130_____10140_____10150_____10160_____10170_____10180_____10190_____10200_____10210_____10220_____10230_____10240_____10250_____10260_____10270_____10280_____10290_____10300_____10310_____10320_____10330_____10340_____10350_____10360_____10370_____10380_____10390_____10400_____10410_____10420_____10430_____10440_____10450_____10460_____10470_____10480_____10490_____10500_____10510_____10520_____10530_____10540_____10550_____10560_____10570_____10580_____10590_____10600_____10610_____10620_____10630_____10640_____10650_____10660_____10670_____10680_____10690_____10700_____10710_____10720_____10730_____10740_____10750_____10760_____10770_____10780_____10790_____10800_____10810_____10820_____10830_____10840_____10850_____10860_____10870_____10880_____10890_____10900_____10910_____10920_____10930_____10940_____10950_____10960_____10970_____10980_____10990_____11000_____11010_____11020_____11030_____11040_____11050_____11060_____11070_____11080_____11090_____11100_____11110_____11120_____11130_____11140_____11150_____11160_____11170_____11180_____11190_____11200_____11210_____11220_____11230_____11240_____11250_____11260_____11270_____11280_____11290_____11300_____11310_____11320_____11330_____11340_____11350_____11360_____11370_____11380_____11390_____11400_____11410_____11420_____11430_____11440_____11450_____11460_____11470_____11480_____11490_____11500_____11510_____11520_____11530_____11540_____11550_____11560_____11570_____11580_____11590_____11600_____11610_____11620_____11630_____11640_____11650_____11660_____11670_____11680_____11690_____11700_____11710_____11720_____11730_____11740_____11750_____11760_____11770_____11780_____11790_____11800_____11810_____11820_____11830_____11840_____11850_____11860_____11870_____11880_____11890_____11900_____11910_____11920_____11930_____11940_____11950_____11960_____11970_____11980_____11990_____12000_____12010_____12020_____12030_____12040_____12050_____12060_____12070_____12080_____12090_____12100_____12110_____12120_____12130_____12140_____12150_____12160_____12170_____12180_____12190_____12200_____12210_____12220_____12230_____12240_____12250_____12260_____12270_____12280_____12290_____12300_____12310_____12320_____12330_____12340_____12350_____12360_____12370_____12380_____12390_____12400_____12410_____12420_____12430_____12440_____12450_____12460_____12470_____12480_____12490_____12500_____12510_____12520_____12530_____12540_____12550_____12560_____12570_____12580_____12590_____12600_____12610_____12620_____12630_____12640_____12650_____12660_____12670_____12680_____12690_____12700_____12710_____12720_____12730_____12740_____12750_____12760_____12770_____12780_____12790_____12800_____12810_____12820_____12830_____12840_____12850_____12860_____12870_____12880_____12890_____12900_____12910_____12920_____12930_____12940_____12950_____12960_____12970_____12980_____12990_____13000_____13010_____13020_____13030_____13040_____13050_____13060_____13070_____13080_____13090_____13100_____13110_____13120_____13130_____13140_____13150_____13160_____13170_____13180_____13190_____13200_____13210_____13220_____13230_____13240_____13250_____13260_____13270_____13280_____13290_____13300_____13310_____13320_____13330_____13340_____13350_____13360_____13370_____13380_____13390_____13400_____13410_____13420_____13430_____13440_____13450_____13460_____13470_____13480_____13490_____13500_____13510_____13520_____13530_____13540_____13550_____13560_____13570_____13580_____13590_____13600_____13610_____13620_____13630_____13640_____13650_____13660_____13670_____13680_____13690_____13700_____13710_____13720_____13730_____13740_____13750_____13760_____13770_____13780_____13790_____13800_____13810_____13820_____13830_____13840_____13850_____13860_____13870_____13880_____13890_____13900_____13910_____13920_____13930_____13940_____13950_____13960_____13970_____13980_____13990_____14000_____14010_____14020_____14030_____14040_____14050_____14060_____14070_____14080_____14090_____14100_____14110_____14120_____14130_____14140_____14150_____14160_____14170_____14180_____14190_____14200_____14210_____14220_____14230_____14240_____14250_____14260_____14270_____14280_____14290_____14300_____14310_____14320_____14330_____14340_____14350_____14360_____14370_____14380_____14390_____14400_____14410_____14420_____14430_____14440_____14450_____14460_____14470_____14480_____14490_____14500_____14510_____14520_____14530_____14540_____14550_____14560_____14570_____14580_____14590_____14600_____14610_____14620_____14630_____14640_____14650_____14660_____14670_____14680_____14690_____14700_____14710_____14720_____14730_____14740_____14750_____14760_____14770_____14780_____14790_____14800_____14810_____14820_____14830_____14840_____14850_____14860_____14870_____14880_____14890_____14900_____14910_____14920_____14930_____14940_____14950_____14960_____14970_____14980_____14990_____15000x');
    }



    /** @test */
    public function validate_metrics_items_valid()
    {
        $this->expectNotToPerformAssertions();

        Validation::validateMetricsItems(['key' => 123]);
    }

    /** @test */
    public function validate_metrics_items_empty()
    {
        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^No items set\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateMetricsItems([]);
    }

    /** @test */
    public function validate_metrics_items_empty_key()
    {
        $this->expectNotToPerformAssertions();

        Validation::validateMetricsItems(['' => 123]);
    }

    /** @test */
    public function validate_metrics_items_too_long_key()
    {
        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^Item key ________10________20________30________40________50x exceeded max length of 50 characters\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateMetricsItems(['________10________20________30________40________50x' => 123]);
    }

    /** @test */
    public function validate_metrics_items_invalid_value()
    {
        $this->expectException(HawkFlowException::class);
        $this->expectExceptionMessageMatches('/^Value of item key is not int or float\. Please see documentation at https:\/\/docs.hawkflow.ai\/integration\/index.html$/');

        Validation::validateMetricsItems(['key' => 'value not int or float']);
    }
}

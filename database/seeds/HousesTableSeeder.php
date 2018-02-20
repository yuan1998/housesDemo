<?php

use Illuminate\Database\Seeder;

class HousesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('houses')->delete();
        
        \DB::table('houses')->insert(array (
            0 => 
            array (
                'id' => 15,
                'title' => '更好的风格和的风格',
                'area' => 123.0,
                'sub_title' => '风格撒的风格撒的发噶人',
                'unit_price' => NULL,
                'first_pay' => NULL,
                'product_info' => '固定好身体也让我层 v 许诺',
                'direction' => '北',
                'location_id' => NULL,
                'visiting_count' => 0,
                'floor' => 4,
                'floors' => 123,
                'house_type' => NULL,
                'house_img' => '{"cover": [{"get": "http://localhost:1234/api/img?file=2018-02-08-16-18-49-14625a7c07e9f2708.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-18-49-14625a7c07e9f2708.jpeg", "name": "2018-02-08-16-18-49-14625a7c07e9f2708.jpeg", "size": "true", "type": "jpeg"}], "house": [{"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-00-12975a7c07f4995f7.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-00-12975a7c07f4995f7.jpeg", "name": "2018-02-08-16-19-00-12975a7c07f4995f7.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-04-13435a7c07f88d571.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-04-13435a7c07f88d571.jpeg", "name": "2018-02-08-16-19-04-13435a7c07f88d571.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-07-16525a7c07fb9f001.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-07-16525a7c07fb9f001.jpeg", "name": "2018-02-08-16-19-07-16525a7c07fb9f001.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-10-11415a7c07fee96f9.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-10-11415a7c07fee96f9.jpeg", "name": "2018-02-08-16-19-10-11415a7c07fee96f9.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-16-18005a7c080428fab.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-16-18005a7c080428fab.jpeg", "name": "2018-02-08-16-19-16-18005a7c080428fab.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-19-10315a7c0807517c0.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-19-10315a7c0807517c0.jpeg", "name": "2018-02-08-16-19-19-10315a7c0807517c0.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-23-15295a7c080bac484.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-23-15295a7c080bac484.jpeg", "name": "2018-02-08-16-19-23-15295a7c080bac484.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-29-13755a7c081159bc3.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-29-13755a7c081159bc3.jpeg", "name": "2018-02-08-16-19-29-13755a7c081159bc3.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-36-13855a7c081861a7e.png", "url": "http://localhost:1234/storage/2018-02-08-16-19-36-13855a7c081861a7e.png", "name": "2018-02-08-16-19-36-13855a7c081861a7e.png", "size": "true", "type": "png"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-42-13065a7c081ec060f.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-42-13065a7c081ec060f.jpeg", "name": "2018-02-08-16-19-42-13065a7c081ec060f.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-53-12165a7c08294f7d8.gif", "url": "http://localhost:1234/storage/2018-02-08-16-19-53-12165a7c08294f7d8.gif", "name": "2018-02-08-16-19-53-12165a7c08294f7d8.gif", "size": "true", "type": "gif"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-20-01-10165a7c083154b32.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-20-01-10165a7c083154b32.jpeg", "name": "2018-02-08-16-20-01-10165a7c083154b32.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-20-09-16355a7c0839c3e20.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-20-09-16355a7c0839c3e20.jpeg", "name": "2018-02-08-16-20-09-16355a7c0839c3e20.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-20-24-17025a7c0848ee662.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-20-24-17025a7c0848ee662.jpeg", "name": "2018-02-08-16-20-24-17025a7c0848ee662.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-20-32-13235a7c085063e90.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-20-32-13235a7c085063e90.jpeg", "name": "2018-02-08-16-20-32-13235a7c085063e90.jpeg", "size": "true", "type": "jpeg"}]}',
                'Decoration' => '毛胚房',
                'floor_age' => '213',
                'supply_heating' => '无供暖',
                'elevator' => '一梯3户',
                'surroundings' => 'dfasdf',
                'community_info' => 'dfasdfasdf',
                'traffic' => 'asdfasdfas',
                'house_age_limit' => '123',
                'huxing_map_info' => '{"hall": {"hall_1": {"arae": "123", "direction": "西南"}}, "balcony": {"balcony_1": {"arae": "123", "direction": "西"}}, "bedroom": {"bedroom_1": {"arae": "123", "direction": "北"}}, "kitchen": {"kitchen_1": {"arae": "123", "direction": "南"}}, "bathroom": {"bathroom_1": {"arae": "123", "direction": "北"}, "bathroom_2": {"arae": "213", "direction": "西"}}}',
                'tags' => '["新房", "学区房", "市中心", "随时看房", "地铁房"]',
                'created_at' => '2018-02-08 16:30:56',
                'updated_at' => '2018-02-08 16:54:14',
                'price' => 1343.0,
                'room_count' => '{"hall": "1", "balcony": "1", "bedroom": "1", "kitchen": "1", "bathroom": "2"}',
                'negative_floor' => '0',
                'deed_info' => '[{"get": "http://localhost:1234/api/img?file=2018-02-08-16-20-54-20195a7c0866ba467.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-20-54-20195a7c0866ba467.jpeg", "name": "2018-02-08-16-20-54-20195a7c0866ba467.jpeg", "size": "true", "type": "jpeg"}]',
                'user_id' => 1,
                'unit_number' => '123',
                'building_number' => '123',
                'house_number' => '123',
                'contact' => '啊实打实大',
                'tel' => '123',
                'expect_price' => '132',
                'community' => '雅居乐',
                'status' => 'sell',
                'location' => '陕西省西安市雁塔区曲江街道雅居乐·御宾府',
                'city' => '西安',
                'hot' => 0,
                'new' => 0,
                'location_info' => '{"lat": "34.016190", "lng": "108.580375", "city": "西安市", "level": "道路", "adcode": "610111", "citycode": "029", "district": "灞桥区", "location": "109.080375,34.216190", "province": "陕西省", "formatted_address": "陕西省西安市灞桥区白鹿西路南段"}',
            ),
            1 => 
            array (
                'id' => 16,
                'title' => '啊实打实大',
                'area' => 123.0,
                'sub_title' => '阿斯顿',
                'unit_price' => NULL,
                'first_pay' => NULL,
                'product_info' => '撒的啊撒睡大时代啊阿斯顿啊撒的阿斯顿撒大时代',
                'direction' => '北',
                'location_id' => NULL,
                'visiting_count' => 0,
                'floor' => 4,
                'floors' => 123,
                'house_type' => NULL,
                'house_img' => '{"cover": [{"get": "http://localhost:1234/api/img?file=2018-02-08-16-18-49-14625a7c07e9f2708.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-18-49-14625a7c07e9f2708.jpeg", "name": "2018-02-08-16-18-49-14625a7c07e9f2708.jpeg", "size": "true", "type": "jpeg"}], "house": [{"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-00-12975a7c07f4995f7.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-00-12975a7c07f4995f7.jpeg", "name": "2018-02-08-16-19-00-12975a7c07f4995f7.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-04-13435a7c07f88d571.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-04-13435a7c07f88d571.jpeg", "name": "2018-02-08-16-19-04-13435a7c07f88d571.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-07-16525a7c07fb9f001.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-07-16525a7c07fb9f001.jpeg", "name": "2018-02-08-16-19-07-16525a7c07fb9f001.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-10-11415a7c07fee96f9.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-10-11415a7c07fee96f9.jpeg", "name": "2018-02-08-16-19-10-11415a7c07fee96f9.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-16-18005a7c080428fab.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-16-18005a7c080428fab.jpeg", "name": "2018-02-08-16-19-16-18005a7c080428fab.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-19-10315a7c0807517c0.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-19-10315a7c0807517c0.jpeg", "name": "2018-02-08-16-19-19-10315a7c0807517c0.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-23-15295a7c080bac484.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-23-15295a7c080bac484.jpeg", "name": "2018-02-08-16-19-23-15295a7c080bac484.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-29-13755a7c081159bc3.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-29-13755a7c081159bc3.jpeg", "name": "2018-02-08-16-19-29-13755a7c081159bc3.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-36-13855a7c081861a7e.png", "url": "http://localhost:1234/storage/2018-02-08-16-19-36-13855a7c081861a7e.png", "name": "2018-02-08-16-19-36-13855a7c081861a7e.png", "size": "true", "type": "png"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-42-13065a7c081ec060f.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-42-13065a7c081ec060f.jpeg", "name": "2018-02-08-16-19-42-13065a7c081ec060f.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-53-12165a7c08294f7d8.gif", "url": "http://localhost:1234/storage/2018-02-08-16-19-53-12165a7c08294f7d8.gif", "name": "2018-02-08-16-19-53-12165a7c08294f7d8.gif", "size": "true", "type": "gif"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-20-01-10165a7c083154b32.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-20-01-10165a7c083154b32.jpeg", "name": "2018-02-08-16-20-01-10165a7c083154b32.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-20-09-16355a7c0839c3e20.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-20-09-16355a7c0839c3e20.jpeg", "name": "2018-02-08-16-20-09-16355a7c0839c3e20.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-20-24-17025a7c0848ee662.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-20-24-17025a7c0848ee662.jpeg", "name": "2018-02-08-16-20-24-17025a7c0848ee662.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-20-32-13235a7c085063e90.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-20-32-13235a7c085063e90.jpeg", "name": "2018-02-08-16-20-32-13235a7c085063e90.jpeg", "size": "true", "type": "jpeg"}]}',
                'Decoration' => '毛胚房',
                'floor_age' => '213',
                'supply_heating' => '无供暖',
                'elevator' => '一梯3户',
                'surroundings' => 'dfasdf',
                'community_info' => 'dfasdfasdf',
                'traffic' => 'asdfasdfas',
                'house_age_limit' => '123',
                'huxing_map_info' => '{"hall": {"hall_1": {"arae": "123", "direction": "西南"}}, "balcony": {"balcony_1": {"arae": "123", "direction": "西"}}, "bedroom": {"bedroom_1": {"arae": "123", "direction": "北"}}, "kitchen": {"kitchen_1": {"arae": "123", "direction": "南"}}, "bathroom": {"bathroom_1": {"arae": "123", "direction": "北"}, "bathroom_2": {"arae": "213", "direction": "西"}}}',
                'tags' => '["地铁房", "随时看房", "市中心", "学区房"]',
                'created_at' => '2018-02-08 16:33:43',
                'updated_at' => '2018-02-08 16:53:44',
                'price' => 213321.0,
                'room_count' => '{"hall": "1", "balcony": "1", "bedroom": "1", "kitchen": "1", "bathroom": "2"}',
                'negative_floor' => '0',
                'deed_info' => '[{"get": "http://localhost:1234/api/img?file=2018-02-08-16-20-54-20195a7c0866ba467.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-20-54-20195a7c0866ba467.jpeg", "name": "2018-02-08-16-20-54-20195a7c0866ba467.jpeg", "size": "true", "type": "jpeg"}]',
                'user_id' => 1,
                'unit_number' => '123',
                'building_number' => '123',
                'house_number' => '123',
                'contact' => '啊实打实大',
                'tel' => '123',
                'expect_price' => '132',
                'community' => '雅居乐',
                'status' => 'sell',
                'location' => '陕西省西安市雁塔区曲江街道雅居乐·御宾府',
                'city' => '西安',
                'hot' => 0,
                'new' => 0,
                'location_info' => '{"lat": "34.016190", "lng": "109.080375", "city": "西安市", "level": "道路", "adcode": "610111", "citycode": "029", "district": "灞桥区", "location": "109.080375,34.216190", "province": "陕西省", "formatted_address": "陕西省西安市灞桥区白鹿西路南段"}',
            ),
            2 => 
            array (
                'id' => 17,
                'title' => '雅居乐 3是阿斯顿啊',
                'area' => 123.0,
                'sub_title' => '啊实打实的',
                'unit_price' => NULL,
                'first_pay' => NULL,
                'product_info' => '撒的发撒的风格形成 v 了',
                'direction' => '北',
                'location_id' => NULL,
                'visiting_count' => 0,
                'floor' => 4,
                'floors' => 123,
                'house_type' => NULL,
                'house_img' => '{"cover": [{"get": "http://localhost:1234/api/img?file=2018-02-08-16-18-49-14625a7c07e9f2708.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-18-49-14625a7c07e9f2708.jpeg", "name": "2018-02-08-16-18-49-14625a7c07e9f2708.jpeg", "size": "true", "type": "jpeg"}], "house": [{"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-00-12975a7c07f4995f7.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-00-12975a7c07f4995f7.jpeg", "name": "2018-02-08-16-19-00-12975a7c07f4995f7.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-04-13435a7c07f88d571.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-04-13435a7c07f88d571.jpeg", "name": "2018-02-08-16-19-04-13435a7c07f88d571.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-07-16525a7c07fb9f001.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-07-16525a7c07fb9f001.jpeg", "name": "2018-02-08-16-19-07-16525a7c07fb9f001.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-10-11415a7c07fee96f9.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-10-11415a7c07fee96f9.jpeg", "name": "2018-02-08-16-19-10-11415a7c07fee96f9.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-16-18005a7c080428fab.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-16-18005a7c080428fab.jpeg", "name": "2018-02-08-16-19-16-18005a7c080428fab.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-19-10315a7c0807517c0.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-19-10315a7c0807517c0.jpeg", "name": "2018-02-08-16-19-19-10315a7c0807517c0.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-23-15295a7c080bac484.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-23-15295a7c080bac484.jpeg", "name": "2018-02-08-16-19-23-15295a7c080bac484.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-29-13755a7c081159bc3.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-29-13755a7c081159bc3.jpeg", "name": "2018-02-08-16-19-29-13755a7c081159bc3.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-36-13855a7c081861a7e.png", "url": "http://localhost:1234/storage/2018-02-08-16-19-36-13855a7c081861a7e.png", "name": "2018-02-08-16-19-36-13855a7c081861a7e.png", "size": "true", "type": "png"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-42-13065a7c081ec060f.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-19-42-13065a7c081ec060f.jpeg", "name": "2018-02-08-16-19-42-13065a7c081ec060f.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-19-53-12165a7c08294f7d8.gif", "url": "http://localhost:1234/storage/2018-02-08-16-19-53-12165a7c08294f7d8.gif", "name": "2018-02-08-16-19-53-12165a7c08294f7d8.gif", "size": "true", "type": "gif"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-20-01-10165a7c083154b32.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-20-01-10165a7c083154b32.jpeg", "name": "2018-02-08-16-20-01-10165a7c083154b32.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-20-09-16355a7c0839c3e20.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-20-09-16355a7c0839c3e20.jpeg", "name": "2018-02-08-16-20-09-16355a7c0839c3e20.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-20-24-17025a7c0848ee662.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-20-24-17025a7c0848ee662.jpeg", "name": "2018-02-08-16-20-24-17025a7c0848ee662.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-08-16-20-32-13235a7c085063e90.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-20-32-13235a7c085063e90.jpeg", "name": "2018-02-08-16-20-32-13235a7c085063e90.jpeg", "size": "true", "type": "jpeg"}]}',
                'Decoration' => '毛胚房',
                'floor_age' => '213',
                'supply_heating' => '无供暖',
                'elevator' => '一梯3户',
                'surroundings' => 'dfasdf',
                'community_info' => 'dfasdfasdf',
                'traffic' => 'asdfasdfas',
                'house_age_limit' => '123',
                'huxing_map_info' => '{"hall": {"hall_1": {"arae": "123", "direction": "西南"}}, "balcony": {"balcony_1": {"arae": "123", "direction": "西"}}, "bedroom": {"bedroom_1": {"arae": "123", "direction": "北"}}, "kitchen": {"kitchen_1": {"arae": "123", "direction": "南"}}, "bathroom": {"bathroom_1": {"arae": "123", "direction": "北"}, "bathroom_2": {"arae": "213", "direction": "西"}}}',
                'tags' => '["地铁房", "市中心", "学区房", "新房", "随时看房"]',
                'created_at' => '2018-02-08 16:35:04',
                'updated_at' => '2018-02-08 16:46:54',
                'price' => 12315.0,
                'room_count' => '{"hall": "1", "balcony": "1", "bedroom": "1", "kitchen": "1", "bathroom": "2"}',
                'negative_floor' => '0',
                'deed_info' => '[{"get": "http://localhost:1234/api/img?file=2018-02-08-16-20-54-20195a7c0866ba467.jpeg", "url": "http://localhost:1234/storage/2018-02-08-16-20-54-20195a7c0866ba467.jpeg", "name": "2018-02-08-16-20-54-20195a7c0866ba467.jpeg", "size": "true", "type": "jpeg"}]',
                'user_id' => 1,
                'unit_number' => '123',
                'building_number' => '123',
                'house_number' => '123',
                'contact' => '啊实打实大',
                'tel' => '123',
                'expect_price' => '132',
                'community' => '雅居乐',
                'status' => 'sell',
                'location' => '陕西省西安市雁塔区曲江街道雅居乐·御宾府',
                'city' => '西安',
                'hot' => 0,
                'new' => 0,
                'location_info' => '{"lat": "34.331929", "lng": "108.936741", "city": "西安市", "level": "道路", "adcode": "610111", "citycode": "029", "district": "灞桥区", "location": "109.080375,34.216190", "province": "陕西省", "formatted_address": "陕西省西安市灞桥区白鹿西路南段"}',
            ),
            3 => 
            array (
                'id' => 18,
                'title' => '使用 Promise 和 ES6',
                'area' => 123.0,
                'sub_title' => '此钩子函数一个类型为切换对象的参数。',
                'unit_price' => NULL,
                'first_pay' => NULL,
                'product_info' => 'I really want set title when I declare routes. e.g

const routes = [{ path: \'/search\', component: ActivityList, title: \'Search\' }]
then title will change by the vue-router.

how ?

ps, I see the pull issue closed. why?
#526',
                'direction' => '东南',
                'location_id' => NULL,
                'visiting_count' => 0,
                'floor' => 2,
                'floors' => 123,
                'house_type' => NULL,
                'house_img' => '{"cover": [{"get": "http://localhost:1234/api/img?file=2018-02-09-15-17-44-15195a7d4b18e5147.jpeg", "url": "http://localhost:1234/storage/2018-02-09-15-17-44-15195a7d4b18e5147.jpeg", "name": "2018-02-09-15-17-44-15195a7d4b18e5147.jpeg", "size": "true", "type": "jpeg"}], "house": [{"get": "http://localhost:1234/api/img?file=2018-02-09-15-17-52-17545a7d4b2008570.jpeg", "url": "http://localhost:1234/storage/2018-02-09-15-17-52-17545a7d4b2008570.jpeg", "name": "2018-02-09-15-17-52-17545a7d4b2008570.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-09-15-17-55-14615a7d4b234ea20.jpeg", "url": "http://localhost:1234/storage/2018-02-09-15-17-55-14615a7d4b234ea20.jpeg", "name": "2018-02-09-15-17-55-14615a7d4b234ea20.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-09-15-17-59-18365a7d4b27078e2.jpeg", "url": "http://localhost:1234/storage/2018-02-09-15-17-59-18365a7d4b27078e2.jpeg", "name": "2018-02-09-15-17-59-18365a7d4b27078e2.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-09-15-18-03-12995a7d4b2b09d26.jpeg", "url": "http://localhost:1234/storage/2018-02-09-15-18-03-12995a7d4b2b09d26.jpeg", "name": "2018-02-09-15-18-03-12995a7d4b2b09d26.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-09-15-18-09-14265a7d4b3118192.jpeg", "url": "http://localhost:1234/storage/2018-02-09-15-18-09-14265a7d4b3118192.jpeg", "name": "2018-02-09-15-18-09-14265a7d4b3118192.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-09-15-18-14-15865a7d4b362a308.gif", "url": "http://localhost:1234/storage/2018-02-09-15-18-14-15865a7d4b362a308.gif", "name": "2018-02-09-15-18-14-15865a7d4b362a308.gif", "size": "true", "type": "gif"}]}',
                'Decoration' => '毛胚房',
                'floor_age' => '213',
                'supply_heating' => '个人供暖',
                'elevator' => '一梯3户',
                'surroundings' => '123',
                'community_info' => '123123123123',
                'traffic' => '123123',
                'house_age_limit' => '213',
                'huxing_map_info' => '{"hall": {"hall_1": {"arae": "123", "direction": "西"}}, "balcony": {"balcony_1": {"arae": "123", "direction": "南"}}, "bedroom": {"bedroom_1": {"arae": "213", "direction": "西"}}, "kitchen": {"kitchen_1": {"arae": "123", "direction": "东"}}, "bathroom": {"bathroom_1": {"arae": "213", "direction": "南"}, "bathroom_2": {"arae": "213", "direction": "西南"}}}',
                'tags' => '["地铁房", "随时看房", "市中心", "学区房", "新房"]',
                'created_at' => '2018-02-09 15:19:48',
                'updated_at' => '2018-02-19 12:57:27',
                'price' => 213.0,
                'room_count' => '{"hall": "1", "balcony": "1", "bedroom": "1", "kitchen": "1", "bathroom": "2"}',
                'negative_floor' => '0',
                'deed_info' => '[{"get": "http://localhost:1234/api/img?file=2018-02-09-15-18-22-13055a7d4b3ed8f4d.jpeg", "url": "http://localhost:1234/storage/2018-02-09-15-18-22-13055a7d4b3ed8f4d.jpeg", "name": "2018-02-09-15-18-22-13055a7d4b3ed8f4d.jpeg", "size": "true", "type": "jpeg"}]',
                'user_id' => 1,
                'unit_number' => '2131',
                'building_number' => '123',
                'house_number' => '213',
                'contact' => '123',
                'tel' => '213123',
                'expect_price' => '213213',
                'community' => '雅居乐',
                'status' => 'sell',
                'location' => '陕西省西安市灞桥区狄寨街道白鹿西路南段',
                'city' => '西安',
                'hot' => 0,
                'new' => 0,
                'location_info' => '{"lat": "34.216190", "lng": "108.080375", "city": "西安市", "level": "道路", "adcode": "610111", "citycode": "029", "district": "灞桥区", "location": "109.080375,34.216190", "province": "陕西省", "formatted_address": "陕西省西安市灞桥区白鹿西路南段"}',
            ),
            4 => 
            array (
                'id' => 19,
                'title' => '啊撒睡',
                'area' => 213.0,
                'sub_title' => '德萨发生的发',
                'unit_price' => NULL,
                'first_pay' => NULL,
                'product_info' => '是否该说的风格是方法是撒的发生发生的发生分胜负爽肤水复古风格的复古风格家哥好机会你风格 v 吧形成 v不 v 不晓得该说的风格和时代感撒的风格撒的风格二哥二哥为根深蒂固说的话说更好风格和风格好是否根深蒂固和人突然说通过',
                'direction' => '西',
                'location_id' => NULL,
                'visiting_count' => 0,
                'floor' => 2,
                'floors' => 123,
                'house_type' => NULL,
                'house_img' => '{"cover": [{"get": "http://localhost:1234/api/img?file=2018-02-14-13-42-10-15745a83cc3277471.gif", "url": "http://localhost:1234/storage/2018-02-14-13-42-10-15745a83cc3277471.gif", "name": "2018-02-14-13-42-10-15745a83cc3277471.gif", "size": "true", "type": "gif"}], "house": [{"get": "http://localhost:1234/api/img?file=2018-02-14-13-42-21-12015a83cc3d0386a.jpeg", "url": "http://localhost:1234/storage/2018-02-14-13-42-21-12015a83cc3d0386a.jpeg", "name": "2018-02-14-13-42-21-12015a83cc3d0386a.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-14-13-42-24-11585a83cc40efdf9.jpeg", "url": "http://localhost:1234/storage/2018-02-14-13-42-24-11585a83cc40efdf9.jpeg", "name": "2018-02-14-13-42-24-11585a83cc40efdf9.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-14-13-42-30-19525a83cc46c9596.jpeg", "url": "http://localhost:1234/storage/2018-02-14-13-42-30-19525a83cc46c9596.jpeg", "name": "2018-02-14-13-42-30-19525a83cc46c9596.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-14-13-42-38-11255a83cc4ee62f0.png", "url": "http://localhost:1234/storage/2018-02-14-13-42-38-11255a83cc4ee62f0.png", "name": "2018-02-14-13-42-38-11255a83cc4ee62f0.png", "size": "true", "type": "png"}, {"get": "http://localhost:1234/api/img?file=2018-02-14-13-42-44-18555a83cc543532a.jpeg", "url": "http://localhost:1234/storage/2018-02-14-13-42-44-18555a83cc543532a.jpeg", "name": "2018-02-14-13-42-44-18555a83cc543532a.jpeg", "size": "true", "type": "jpeg"}]}',
                'Decoration' => '简装',
                'floor_age' => '213',
                'supply_heating' => '个人供暖',
                'elevator' => '其他',
                'surroundings' => '西塞带哦',
                'community_info' => '没考虑过的宝宝健康啦哥哥你快收藏 v 军绿色的发生 v崩坏开始v 不会考虑比较宽松的发',
                'traffic' => '撒大的啊 许可名不虚传没考虑',
                'house_age_limit' => '213',
                'huxing_map_info' => '{"hall": {"hall_1": {"arae": "123", "direction": "北"}}, "balcony": {"balcony_1": {"arae": "231", "direction": "南"}}, "bedroom": {"bedroom_1": {"arae": "213", "direction": "西北"}}, "kitchen": {"kitchen_1": {"arae": "213", "direction": "南"}}, "bathroom": {"bathroom_1": {"arae": "213", "direction": "东南"}, "bathroom_2": {"arae": "231", "direction": "西"}}}',
                'tags' => '["新房", "学区房", "市中心", "随时看房", "地铁房"]',
                'created_at' => '2018-02-14 13:43:45',
                'updated_at' => '2018-02-15 18:12:04',
                'price' => 213134.0,
                'room_count' => '{"hall": "1", "balcony": "1", "bedroom": "1", "kitchen": "1", "bathroom": "2"}',
                'negative_floor' => '0',
                'deed_info' => '[{"get": "http://localhost:1234/api/img?file=2018-02-14-13-43-10-14815a83cc6ed0f77.jpeg", "url": "http://localhost:1234/storage/2018-02-14-13-43-10-14815a83cc6ed0f77.jpeg", "name": "2018-02-14-13-43-10-14815a83cc6ed0f77.jpeg", "size": "true", "type": "jpeg"}]',
                'user_id' => 1,
                'unit_number' => '123',
                'building_number' => '123',
                'house_number' => '123',
                'contact' => '213',
                'tel' => '123',
                'expect_price' => '123',
                'community' => '户',
                'status' => 'sell',
                'location' => '陕西省西安市未央区张家堡街道文景路风景御园',
                'city' => '西安',
                'hot' => 0,
                'new' => 0,
                'location_info' => '{"lat": "34.339209", "lng": "108.940037", "city": "西安市", "level": "兴趣点", "adcode": "610112", "citycode": "029", "district": "未央区", "location": "108.940037,34.339209", "province": "陕西省", "formatted_address": "陕西省西安市未央区风景御园"}',
            ),
            5 => 
            array (
                'id' => 20,
                'title' => 'action来发送请求，然后本意是想在then方法里面判断权限',
                'area' => 123.0,
                'sub_title' => '如果改用 async/await 呢，会是这样',
                'unit_price' => NULL,
                'first_pay' => NULL,
                'product_info' => '2018 Lincoln Navigator : Full-Size Luxury SUVs - Lincoln.com',
                'direction' => '北',
                'location_id' => NULL,
                'visiting_count' => 0,
                'floor' => 3,
                'floors' => 231,
                'house_type' => NULL,
                'house_img' => '{"cover": [{"get": "http://localhost:1234/api/img?file=2018-02-19-12-58-51-15905a8a598bc04d7.png", "url": "http://localhost:1234/storage/2018-02-19-12-58-51-15905a8a598bc04d7.png", "name": "2018-02-19-12-58-51-15905a8a598bc04d7.png", "size": "true", "type": "png"}], "house": [{"get": "http://localhost:1234/api/img?file=2018-02-19-12-59-00-14465a8a5994acf6b.jpeg", "url": "http://localhost:1234/storage/2018-02-19-12-59-00-14465a8a5994acf6b.jpeg", "name": "2018-02-19-12-59-00-14465a8a5994acf6b.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-12-59-03-10905a8a5997e71ce.jpeg", "url": "http://localhost:1234/storage/2018-02-19-12-59-03-10905a8a5997e71ce.jpeg", "name": "2018-02-19-12-59-03-10905a8a5997e71ce.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-12-59-07-16095a8a599b36316.jpeg", "url": "http://localhost:1234/storage/2018-02-19-12-59-07-16095a8a599b36316.jpeg", "name": "2018-02-19-12-59-07-16095a8a599b36316.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-12-59-10-15415a8a599e3a1a3.jpeg", "url": "http://localhost:1234/storage/2018-02-19-12-59-10-15415a8a599e3a1a3.jpeg", "name": "2018-02-19-12-59-10-15415a8a599e3a1a3.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-12-59-15-12335a8a59a348283.jpeg", "url": "http://localhost:1234/storage/2018-02-19-12-59-15-12335a8a59a348283.jpeg", "name": "2018-02-19-12-59-15-12335a8a59a348283.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-12-59-18-19745a8a59a691c40.jpeg", "url": "http://localhost:1234/storage/2018-02-19-12-59-18-19745a8a59a691c40.jpeg", "name": "2018-02-19-12-59-18-19745a8a59a691c40.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-12-59-23-20165a8a59abc36c7.jpeg", "url": "http://localhost:1234/storage/2018-02-19-12-59-23-20165a8a59abc36c7.jpeg", "name": "2018-02-19-12-59-23-20165a8a59abc36c7.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-12-59-29-12935a8a59b1a27d1.jpeg", "url": "http://localhost:1234/storage/2018-02-19-12-59-29-12935a8a59b1a27d1.jpeg", "name": "2018-02-19-12-59-29-12935a8a59b1a27d1.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-12-59-35-17755a8a59b721b52.jpeg", "url": "http://localhost:1234/storage/2018-02-19-12-59-35-17755a8a59b721b52.jpeg", "name": "2018-02-19-12-59-35-17755a8a59b721b52.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-12-59-42-15635a8a59bea8fde.jpeg", "url": "http://localhost:1234/storage/2018-02-19-12-59-42-15635a8a59bea8fde.jpeg", "name": "2018-02-19-12-59-42-15635a8a59bea8fde.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-12-59-48-14155a8a59c464827.jpeg", "url": "http://localhost:1234/storage/2018-02-19-12-59-48-14155a8a59c464827.jpeg", "name": "2018-02-19-12-59-48-14155a8a59c464827.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-13-00-09-16375a8a59d9cc63d.jpeg", "url": "http://localhost:1234/storage/2018-02-19-13-00-09-16375a8a59d9cc63d.jpeg", "name": "2018-02-19-13-00-09-16375a8a59d9cc63d.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-13-00-16-15365a8a59e099090.jpeg", "url": "http://localhost:1234/storage/2018-02-19-13-00-16-15365a8a59e099090.jpeg", "name": "2018-02-19-13-00-16-15365a8a59e099090.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-13-00-24-17575a8a59e866db9.jpeg", "url": "http://localhost:1234/storage/2018-02-19-13-00-24-17575a8a59e866db9.jpeg", "name": "2018-02-19-13-00-24-17575a8a59e866db9.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-13-00-33-18965a8a59f115504.jpeg", "url": "http://localhost:1234/storage/2018-02-19-13-00-33-18965a8a59f115504.jpeg", "name": "2018-02-19-13-00-33-18965a8a59f115504.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-13-00-39-10805a8a59f7e5a06.jpeg", "url": "http://localhost:1234/storage/2018-02-19-13-00-39-10805a8a59f7e5a06.jpeg", "name": "2018-02-19-13-00-39-10805a8a59f7e5a06.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-13-00-50-11205a8a5a0247d56.jpeg", "url": "http://localhost:1234/storage/2018-02-19-13-00-50-11205a8a5a0247d56.jpeg", "name": "2018-02-19-13-00-50-11205a8a5a0247d56.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-13-01-00-14525a8a5a0c1aee7.jpeg", "url": "http://localhost:1234/storage/2018-02-19-13-01-00-14525a8a5a0c1aee7.jpeg", "name": "2018-02-19-13-01-00-14525a8a5a0c1aee7.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-13-01-05-12005a8a5a11c0f1b.jpeg", "url": "http://localhost:1234/storage/2018-02-19-13-01-05-12005a8a5a11c0f1b.jpeg", "name": "2018-02-19-13-01-05-12005a8a5a11c0f1b.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-13-01-11-18985a8a5a1735d56.jpeg", "url": "http://localhost:1234/storage/2018-02-19-13-01-11-18985a8a5a1735d56.jpeg", "name": "2018-02-19-13-01-11-18985a8a5a1735d56.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-13-01-15-13735a8a5a1b1ce21.png", "url": "http://localhost:1234/storage/2018-02-19-13-01-15-13735a8a5a1b1ce21.png", "name": "2018-02-19-13-01-15-13735a8a5a1b1ce21.png", "size": "true", "type": "png"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-13-01-19-13005a8a5a1fb1581.jpeg", "url": "http://localhost:1234/storage/2018-02-19-13-01-19-13005a8a5a1fb1581.jpeg", "name": "2018-02-19-13-01-19-13005a8a5a1fb1581.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-13-01-23-17155a8a5a2324e03.jpeg", "url": "http://localhost:1234/storage/2018-02-19-13-01-23-17155a8a5a2324e03.jpeg", "name": "2018-02-19-13-01-23-17155a8a5a2324e03.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-13-01-33-16905a8a5a2d101f7.jpeg", "url": "http://localhost:1234/storage/2018-02-19-13-01-33-16905a8a5a2d101f7.jpeg", "name": "2018-02-19-13-01-33-16905a8a5a2d101f7.jpeg", "size": "true", "type": "jpeg"}, {"get": "http://localhost:1234/api/img?file=2018-02-19-13-01-44-17105a8a5a3899e14.jpeg", "url": "http://localhost:1234/storage/2018-02-19-13-01-44-17105a8a5a3899e14.jpeg", "name": "2018-02-19-13-01-44-17105a8a5a3899e14.jpeg", "size": "true", "type": "jpeg"}]}',
                'Decoration' => '毛胚房',
                'floor_age' => '231',
                'supply_heating' => '个人供暖',
                'elevator' => '一梯3户',
                'surroundings' => '注意导航守卫并没有应用在跳转路由上，而仅仅应用在其目标上。在下面这个例子中，为 /a 路由添加一个 beforeEach 或 beforeLeave 守卫并不会有任何效果。

其它高级用法，请参考例子。',
                'community_info' => '『别名』的功能让你可以自由地将 UI 结构映射到任意的 URL，而不是受限于配置的嵌套路由结构。

更多高级用法，请查看例子。',
                'traffic' => '『重定向』的意思是，当用户访问 /a时，URL 将会被替换成 /b，然后匹配路由为 /b，那么『别名』又是什么呢？

/a 的别名是 /b，意味着，当用户访问 /b 时，URL 会保持为 /b，但是路由匹配则为 /a，就像用户访问 /a 一样。

上面对应的路由配置为：',
                'house_age_limit' => '231',
                'huxing_map_info' => '{"hall": {"hall_1": {"arae": "213", "direction": "东南"}}, "balcony": {"balcony_1": {"arae": "231", "direction": "北"}}, "bedroom": {"bedroom_1": {"arae": "231", "direction": "北"}}, "kitchen": {"kitchen_1": {"arae": "231", "direction": "南"}}, "bathroom": {"bathroom_1": {"arae": "231", "direction": "北"}, "bathroom_2": {"arae": "231", "direction": "西"}}}',
                'tags' => '["地铁房", "随时看房", "市中心", "学区房", "新房"]',
                'created_at' => '2018-02-19 13:02:27',
                'updated_at' => '2018-02-19 13:03:26',
                'price' => 15150.0,
                'room_count' => '{"hall": "1", "balcony": "1", "bedroom": "1", "kitchen": "1", "bathroom": "2"}',
                'negative_floor' => '0',
                'deed_info' => '[{"get": "http://localhost:1234/api/img?file=2018-02-19-13-02-19-19485a8a5a5b124d5.jpeg", "url": "http://localhost:1234/storage/2018-02-19-13-02-19-19485a8a5a5b124d5.jpeg", "name": "2018-02-19-13-02-19-19485a8a5a5b124d5.jpeg", "size": "true", "type": "jpeg"}]',
                'user_id' => 1,
                'unit_number' => '213',
                'building_number' => '213',
                'house_number' => '213',
                'contact' => '231',
                'tel' => '231',
                'expect_price' => '321',
                'community' => '延东小区',
                'status' => 'sell',
                'location' => '陕西省西安市未央区张家堡街道名栩茶业盐东小区',
                'city' => '西安',
                'hot' => 0,
                'new' => 0,
                'location_info' => '{"lat": "108.933216", "lng": "34.341867", "city": "西安市", "level": "兴趣点", "adcode": "610112", "citycode": "029", "district": "未央区", "location": "108.933216,34.341867", "province": "陕西省", "formatted_address": "陕西省西安市未央区延东小区"}',
            ),
        ));
        
        
    }
}
<?php

class BlogControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->clearDatabase();
        $this->app->bind('ModernPUG\FeedReader\IReader', 'ModernPUG\FeedReader\Reader');
    }

    public function testIndex()
    {
        $this->action('GET', 'BlogController@index');
//        $this->assertViewHas('blogs');
//        $this->assertViewMissing('blog');
    }

    /*
     * 1. REQUEST 객체로 부터 rss주소를 받는다.
     * 2. feed객체로 rss주소로부터 title을 추출한다.
     * 3. uri객체로 rss주소로부터 hostUrl을 추출한다.
     * 4. blogs 테이블에 title, url, host를 입력한다.
     * 5. code 23000 exception이 발생하면 message에 에러 메시지를 입력하여 /blog로 redirect한다.
     * 6. code 23000 exception이 발생하지 않으면 message없이  /blog로 redirect한다.
     */
    public function testStoreFailByDuplicate()
    {
        $user = new \App\User(['email' => 'example@example.com']);

        $this->be($user);
        $blog = new \Mockery\Mock('\App\Blog');
        $blog->shouldReceive('create')->once();
        $testUrlFeed = ['feed_url' => 'http://blog.wani.kr/feed.xml'];

        $this->call('POST', 'blog', $testUrlFeed);
//        $this->assertRedirectedTo('blog');
//        $this->assertSessionHas('message');
    }

    public function testStoreSuccess()
    {
        $user = new \App\User(['email' => 'example@example.com']);

        $this->be($user);
        $blog = new \Mockery\Mock('\App\Blog');
        $blog->shouldReceive('create')->once();
        $testUrlFeed = ['feed_url' => 'http://bookworm.pe.kr/wordpress/feed'];

        $this->call('POST', 'blog', $testUrlFeed);
//        $this->assertRedirectedTo('blog');
    }

    public function testStoreFailByEmptyUrl()
    {
        $user = new \App\User(['email' => 'example@example.com']);
        $this->be($user);
        $testUrlFeed = ['feed_url' => ''];

        $this->call('POST', 'blog', $testUrlFeed);
//        $this->assertRedirectedTo('blog');
//        $this->assertSessionHas('message', '누락된 값이 있습니다.');
    }

    public function testStoreFailByInvalidRssType()
    {
        $user = new \App\User(['email' => 'example@example.com']);
        $this->be($user);
        $invalidTypeUrl = ['feed_url' => 'http://bookworm.pe.kr/wordpress'];
        $this->call('POST', 'blog', $invalidTypeUrl);
//        $this->assertRedirectedTo('blog');
//        $this->assertSessionHas('message', '부적합한 RSS 주소 입니다.');
    }
}

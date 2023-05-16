<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.0
 * @license       https://basercms.net/license/index.html MIT License
 */

namespace BcBlog\Test\TestCase\Service\Admin;

use BaserCore\Service\UsersServiceInterface;
use BaserCore\Test\Scenario\InitAppScenario;
use BaserCore\TestSuite\BcTestCase;
use BcBlog\Service\Admin\BlogPostsAdminService;
use BcBlog\Service\Admin\BlogPostsAdminServiceInterface;
use BcBlog\Service\BlogPostsServiceInterface;
use BcBlog\Test\Scenario\BlogPostsAdminServiceScenario;
use CakephpFixtureFactories\Scenario\ScenarioAwareTrait;

/**
 * Class BlogContentsAdminServiceTest
 * @property BlogPostsAdminService $BlogPostsAdminService
 */
class BlogPostsAdminServiceTest extends BcTestCase
{

    /**
     * Trait
     */
    use ScenarioAwareTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.BaserCore.Factory/Sites',
        'plugin.BaserCore.Factory/SiteConfigs',
        'plugin.BaserCore.Factory/Users',
        'plugin.BaserCore.Factory/UsersUserGroups',
        'plugin.BaserCore.Factory/UserGroups',
        'plugin.BaserCore.Factory/Contents',
        'plugin.BcBlog.Factory/BlogPosts',
        'plugin.BcBlog.Factory/BlogContents',
    ];

    /**
     * Set Up
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->BlogPostsAdminService = $this->getService(BlogPostsAdminServiceInterface::class);
    }

    /**
     * Tear Down
     *
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * test getViewVarsForIndex
     */
    public function test_getViewVarsForIndex()
    {
        // データを作成する
        $this->loadFixtureScenario(BlogPostsAdminServiceScenario::class);
        $this->loadFixtureScenario(InitAppScenario::class);

        $post = ['id' => 1];
        $request = $this->loginAdmin($this->getRequest()->withParam('pass.0', 1));
        $result = $this->BlogPostsAdminService->getViewVarsForIndex($post, $request);

        // 戻り値の中身を確認する
        $this->assertEquals($post, $result['posts']);
        $this->assertEquals(1, $result['blogContent']->id);
        $this->assertNotEmpty($result['users']);
        $this->assertEquals('https://localhost/', $result['publishLink']);
    }

    /**
     * test getViewVarsForAdd
     */
    public function test_getViewVarsForAdd()
    {
        //サービスクラス
        $blogPostsService = $this->getService(BlogPostsServiceInterface::class);
        $userService = $this->getService(UsersServiceInterface::class);

        // データを作成する
        $this->loadFixtureScenario(BlogPostsAdminServiceScenario::class);
        $this->loadFixtureScenario(InitAppScenario::class);

        $request = $this->getRequest('/baser/admin')->withParam('pass.0', 1);

        $post = $blogPostsService->get(1);
        $user = $userService->get(1);
        $result = $this->BlogPostsAdminService->getViewVarsForAdd($request, $post, $user);

        // 戻り値の中身を確認する
        $this->assertEquals($post, $result['post']);
        $this->assertEquals(1, $result['blogContent']->id);
        $this->assertArrayHasKey('editor', $result);
        $this->assertArrayHasKey('editorOptions', $result);
        $this->assertArrayHasKey('editorEnterBr', $result);
        $this->assertArrayHasKey('users', $result);
        $this->assertArrayHasKey('categories', $result);
        $this->assertArrayHasKey('hasNewCategoryAddablePermission', $result);
        $this->assertArrayHasKey('hasNewTagAddablePermission', $result);
    }

    /**
     * test getViewVarsForEdit
     */
    public function test_getViewVarsForEdit()
    {
        //サービスクラス
        $userService = $this->getService(UsersServiceInterface::class);
        $blogPostsService = $this->getService(BlogPostsServiceInterface::class);
        $userService = $this->getService(UsersServiceInterface::class);

        // データを作成する
        $this->loadFixtureScenario(BlogPostsAdminServiceScenario::class);
        $this->loadFixtureScenario(InitAppScenario::class);

        $request = $this->getRequest('/baser/admin')->withParam('pass.0', 1);

        $post = $blogPostsService->get(1);
        $user = $userService->get(1);
        $result = $this->BlogPostsAdminService->getViewVarsForEdit($request, $post, $user);

        // 戻り値の中身を確認する
        $this->assertEquals($post, $result['post']);
        $this->assertEquals(1, $result['blogContent']->id);
        $this->assertArrayHasKey('editor', $result);
        $this->assertArrayHasKey('editorOptions', $result);
        $this->assertArrayHasKey('editorEnterBr', $result);
        $this->assertArrayHasKey('users', $result);
        $this->assertArrayHasKey('categories', $result);
        $this->assertArrayHasKey('hasNewCategoryAddablePermission', $result);
        $this->assertArrayHasKey('hasNewTagAddablePermission', $result);
        $this->assertArrayHasKey('publishLink', $result);
    }

    /**
     * test getPublishLink
     */
    public function test_getPublishLink()
    {
        // データを作成する
        $this->loadFixtureScenario(BlogPostsAdminServiceScenario::class);
        $this->loadFixtureScenario(InitAppScenario::class);
        //サービスクラス
        $blogPostsService = $this->getService(BlogPostsServiceInterface::class);

        //BlogPostsがPublishの場合、
        $post = $blogPostsService->get(1);
        $rs = $this->BlogPostsAdminService->getPublishLink($post);
        $this->assertEquals($rs, 'https://localhost/archives/1');

        //BlogPostsがunpublishの場合、
        $blogPostsService->unpublish(1);
        $post = $blogPostsService->get(1);
        $rs = $this->BlogPostsAdminService->getPublishLink($post);
        $this->assertEquals($rs, '');
    }

    /**
     * test getEditorOptions
     */
    public function test_getEditorOptions()
    {
        $this->markTestIncomplete('このテストは、まだ実装されていません。');
    }

}

/** When your routing table is too long, you can split it into small modules **/

import Layout from '@/layout'

const articleRouter = {
  path: '/article',
  component: Layout,
  redirect: 'noRedirect',
  name: 'article-mgr',
  meta: {
    title: '文章管理',
    icon: 'component',
    roles: ['article.index'] // you can set roles in root nav
  },
  children: [
    {
      path: 'article-list',
      component: () => import('@/views/article-mgr/article-list'),
      name: 'ArticleList',
      meta: {
        title: '文章列表',
        roles: ['article.index'] // or you can only set roles in sub nav
      }
    },
    {
      path: 'articles-groups-list',
      component: () => import('@/views/components-demo/tinymce'),
      name: 'TinymceDemo',
      meta: {
        title: '文章分组',
        roles: ['article.index'] // or you can only set roles in sub nav
      }
    }
  ]
}

export default articleRouter

# 日澤國際股份有限公司

### Blade API

#### 最新消息

*   PostView::all( integer )

    <table>

    <tbody>

    <tr>

    <td>用途：</td>

    <td>取得所有最新消息</td>

    </tr>

    <tr>

    <td>調用方式：</td>

    <td>變數影響每一段分頁的項目數，若不帶入則預設為每一頁15項</td>

    </tr>

    </tbody>

    </table>

*   PostView::getById( integer )

    <table>

    <tbody>

    <tr>

    <td>用途：</td>

    <td>取得最新消息資料</td>

    </tr>

    <tr>

    <td>調用方式：</td>

    <td>以id取得最新消息資料</td>

    </tr>

    </tbody>

    </table>

*   PostView::getByPath( string )

    <table>

    <tbody>

    <tr>

    <td>用途：</td>

    <td>取得最新消息資料</td>

    </tr>

    <tr>

    <td>調用方式：</td>

    <td>以customPath取得最新消息資料(待測試)。</td>

    </tr>

    </tbody>

    </table>

*   PostView::getNewestPosts( integer )

    <table>

    <tbody>

    <tr>

    <td>用途：</td>

    <td>取得最新最新消息列表</td>

    </tr>

    <tr>

    <td>調用方式：</td>

    <td>變數影響每一段分頁的項目數，若不帶入則預設為每一頁4項(待測試)。</td>

    </tr>

    </tbody>

    </table>

*   PostView::getByCategory( string, integer )

    <table>

    <tbody>

    <tr>

    <td>用途：</td>

    <td>依類別取得最新消息列表</td>

    </tr>

    <tr>

    <td>調用方式：</td>

    <td>帶入類別的guid以取得最新消息列表，第二項變數為分頁控制變數，若不帶入則預設為每一頁15個項目。</td>

    </tr>

    </tbody>

    </table>
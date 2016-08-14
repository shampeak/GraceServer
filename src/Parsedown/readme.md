## Grace\Parsedown
> markdown to html

### 依赖

composer
>"erusev/parsedown": "^1.6"

### 配置

无

### 示例

- markdwon 解析成 html
    ```
    $parsedown = server('parsedown');       //获取parsedown对象

    //get markdown
    $markdown = file_get_content('readme.md')

    //get html
    $nr = $parsedown->text($markdown);
    ```
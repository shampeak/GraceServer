## Grace\Parsedown
> markdown to html

   ### 依赖

   composer
   >"erusev/parsedown": "^1.6"

   ### 示例

   - markdwon 解析成 html

   ```
   //get markdown
   $markdown = file_get_content('readme.md')

   //get html
   $nr = $parsedown->text($markdown);
   ```
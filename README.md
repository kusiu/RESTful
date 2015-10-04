api.dev
=======

Create article data:
app/console doctrine:fixtures:load

Get list of articles:
http http://api.dev/app_dev.php/articles

Add new an article:
curl -i -X POST \
   -H "Content-Type:application/json" \
   -d \
'{"title":"Article Title", "content":"Article Content"}' \
 'http://api.dev/app_dev.php/articles.json'


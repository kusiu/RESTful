api.dev
=======

##Create article data:##

<code>
app/console doctrine:schema:drop --force --full-database
app/console doctrine:schema:update --force
app/console doctrine:fixtures:load
</code>

##Get list of articles:##

<code>
curl -i -X GET \
   -H "Content-Type:application/json" \
   -d \
 'http://api.dev/app_dev.php/articles.json'
</code>

##Add new an article:##

<code>
curl -i -X POST \
   -H "Content-Type:application/json" \
   -d \
'{"title":"Article Title", "content":"Article Content"}' \
 'http://api.dev/app_dev.php/articles.json'
</code>

##Add new answer of article by id:##

<code>
curl -i -X POST \
   -H "Content-Type:application/json" \
   -d \
'{"id":"1", "content":"Comment"}' \
 'http://api.dev/app_dev.php/answers.json'
</code>

##Rate an article:##

<code>
curl -i -X POST \
-H "Content-Type:application/json" \
-d \
'{"id":"1", "value":5}' \
'http://api.dev/app_dev.php/rates.json'
</code>
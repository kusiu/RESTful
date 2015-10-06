#api.dev#

###Create article data:###
<code>
app/console doctrine:schema:drop --force --full-database
app/console doctrine:schema:update --force
app/console doctrine:fixtures:load
</code>

###Get list of articles:###
<code>
    curl -i -X GET
    -H "Content-Type:application/json"
    'http://api.kusiu.com/articles.json'
</code>

###Add new an article:###
<code>
    curl -i -X POST \
       -H "Content-Type:application/json" \
       -d \
    '{"title":"Article Title", "content":"Article Content"}' \
     'http://api.kusiu.com/articles.json'
</code>

###Add new answer of article by id:###
<code>
    curl -i -X POST \
       -H "Content-Type:application/json" \
       -d \
    '{"id":"1", "content":"Comment"}' \
     'http://api.kusiu.com/answers.json'
</code>

###Rate an article:###
<code>
    curl -i -X POST \
    -H "Content-Type:application/json" \
    -d \
    '{"id":"1", "value":5}' \
    'http://api.kusiu.com/rates.json'
</code>

###Front page that will allow us to write an article:###
<code>
    http://api.kusiu.com
</code>

###command that will send an email to the writer of an article if he has notifications from more than 24 hours(todo: logic):###
<code>
    app/console mail:author
</code>
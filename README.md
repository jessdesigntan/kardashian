# kardashian

## Installation
Download Solr 6.4.1 http://lucene.apache.org/solr/

## Start Solr
Make sure command prompt is in the folder solr-6.4.1  
Run "bin/solr start"  
Browser > http://localhost:8983/solr

## To Stop Solr
Run "bin/solr stop"  

## Create core
Run "bin/solr create -c data"  
"data" is the name of the new project

## After creating core
Refresh browser > http://localhost:8983/solr  
Choose "data" in core selector dropdown

## To add JSON data
Select documents  
Paste this in:  

{
  "source" : "channel news asia",
  "title" : "kylie jenner in LA",
  "content" : "lorem ipsum",
  "date" : "12-01-2017",
  "url" : "http://jessdesigntan.com/"
},
{
  "source" : "the straits time",
  "title" : "kim kardashian robbed!",
  "content" : "kim lorem kim ipsum",
  "date" : "25-04-2017",
  "url" : "http://jessdesigntan.com/"
}

Then Execute


## Turn single value in to NON ARRAY
Go to : solr-6.4.1/server/solr/data/conf/managed-schema  
Ctrl-f "source", change type="strings" to type="string" (without the s)  
Repeat this for title, content, date and url

## To delete all documents (data)
Run this in the browser  
http://localhost:8983/solr/data/update?stream.body=<delete><query>*:*</query></delete>&commit=true

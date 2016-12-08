# Top Level Routes

Top Level routes include

Home page
* route: /

About page
* route: /about

Contact page
* route: /contact

Collections
* route: /collections

Search / Browse
* route: /search

Single Item / Record
* route: /item/{pid}

Single Item / Catch All Route
/item/{pid}/[{params:.*}]

## Plans:
	Transparently convey API responses (when appropriate) and general frontend errors through a combination of HTTP Status Codes and human readable renderings.
# WebP converter plugin for October CMS
Converts JPEG and PNG images in the storage folder to the WebP format and caches them for later use. Conversion is performed when an image is requested.

## Instructions for Nginx
Add the following location directive to your Nginx configuration:
```
location ~* ^/storage/.*\.(png|jpe?g)$ {
    add_header Vary Accept;
    expires 365d;

    if ($http_accept !~* "webp"){
        break;
    }

    try_files $uri.webp /plugins/damianlewis/webpconvert/webp-on-demand.php?source=$uri;
}
``` 
Then reload the Nginx configuration.

## Instructions for Apache
Add the following header and rewrite rules to your Apache configuration:
```apacheconfig
<IfModule mod_headers.c>
    SetEnvIf Request_URI "\.(jpe?g|png)" ADDVARY
    Header append "Vary" "Accept" env=ADDVARY
</IfModule>

<IfModule mod_rewrite.c>
    RewriteEngine On

    RewriteCond %{HTTP_ACCEPT} image/webp
    RewriteCond %{REQUEST_FILENAME}.webp -f
    RewriteRule ^\/?(.+)\.(jpe?g|png)$ $1.$2.webp [T=image/webp,L]

    RewriteCond %{HTTP_ACCEPT} image/webp
    RewriteCond %{REQUEST_FILENAME} -f
    RewriteRule ^(.*)\.(jpe?g|png)$ %{DOCUMENT_ROOT}/plugins/damianlewis/webpconvert/webp-on-demand.php?source=%{SCRIPT_FILENAME} [NC,L]
</IfModule>

AddType image/webp .webp
``` 
Then reload the Apache configuration.
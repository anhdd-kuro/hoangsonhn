# WordPress公式イメージでは /usr/local/etc/php/conf.d 内に適当な名前の ini ファイルを作れば、
# php.ini に書き加えたのと同じ扱いになるので、起動時に /usr/local/etc/php/conf.d/*.ini を読み込むように設定する
FROM wordpress:latest

# PHP.ini Settings
COPY ./wp-config.ini /usr/local/etc/php/conf.d/wp-config.ini
COPY ./php.ini /usr/local/etc/php/php.ini
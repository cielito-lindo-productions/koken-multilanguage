MultiLanguage for Koken
=================================

This [Koken](http://koken.me) plugin allows you to quickly and easily integrate several languages into your page.

Requirements
------------

1. [Koken](http://koken.me) installation (0.2.0 or higher)

Demonstration
------------

See [Cielito Lindo Productions](https://www.cielitolindo.de) for a demonstration of the plugin

Installation
------------

1. Upload the koken-multilanguage folder to your Koken installation's storage/plugins directory.

2. Sign in to Koken, then visit the Settings > Plugins page to activate the plugin.

3. If necessary you can set a fallback language. If none is selected then english will be used.

4. Add in your template a language selector with eg. 
```html
<a href='./?lng=en'>en</a>&nbsp;|&nbsp;<a href='./?lng=de'>de</a>
```

5. Open the Developer Console of your browser und copy the missing strings that show up into your translation files on your webspace.

6. Translate the strings into the desired languages.

7. Once finished enable translation caching via the plugin settings. This loads tem faster but also makes translations more reliable for your page visitors.

Further information
---------
If you want to get some further information about this plugin please read [this](https://www.cielitolindo.de/essays/2017/10/enable-multi-language-support-on-a-koken-site/) blog post


Changelog
---------

1.1 - Implement browser language detection and translation caching

1.0 - Initial release

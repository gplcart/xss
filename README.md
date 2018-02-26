[![Build Status](https://scrutinizer-ci.com/g/gplcart/xss/badges/build.png?b=master)](https://scrutinizer-ci.com/g/gplcart/xss/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gplcart/xss/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gplcart/xss/?branch=master)

XSS filter is a [GPL Cart](https://github.com/gplcart/gplcart) module that intended to protect site visitors from XSS vulnerabilities. Essentially it filters out all dangerous tags and entities from HTML passed into `$this->filter()` function in theme templates. Administrators can decide which tags should be kept in the filtered text.

**Installation**

1. Download and extract to `system/modules` manually or using composer `composer require gplcart/xss`. IMPORTANT: If you downloaded the module manually, be sure that the name of extracted module folder doesn't contain a branch/version suffix, e.g `-master`. Rename if needed.
2. Go to `admin/module/list` end enable the module
3. Adjust list of allowed tags at `admin/module/settings/xss`
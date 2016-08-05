/*
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

function GithubRssBlock(options) {
    this.settings = options.settings;
    this.init();
}

GithubRssBlock.prototype = {

    init: function() {
        if(jQuery('.'+this.settings.id).length > 0) {
            this.catchLinks(this);
        }
    },

    catchLinks: function(obj) {
        var base_url = obj.settings.base_url;

        $('.'+this.settings.id).find('a').each(function(e) {
            var href = $(this).attr('href');
            $(this).attr('href', base_url+href);
            $(this).attr("target", "_blank");
        });
    }
}

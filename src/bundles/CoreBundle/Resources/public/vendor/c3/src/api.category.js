/*
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamorw <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

c3_chart_fn.category = function (i, category) {
    var $$ = this.internal, config = $$.config;
    if (arguments.length > 1) {
        config.axis_x_categories[i] = category;
        $$.redraw();
    }
    return config.axis_x_categories[i];
};
c3_chart_fn.categories = function (categories) {
    var $$ = this.internal, config = $$.config;
    if (!arguments.length) { return config.axis_x_categories; }
    config.axis_x_categories = categories;
    $$.redraw();
    return config.axis_x_categories;
};

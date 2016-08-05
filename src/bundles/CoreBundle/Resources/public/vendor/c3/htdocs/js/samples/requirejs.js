/*
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamorw <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

require.config({
    baseUrl: '/js',
    paths: {
        d3: "http://d3js.org/d3.v3.min"
    }
});

require(["d3", "c3"], function(d3, c3) {

    window.chart = c3.generate({
        data: {
            columns: [
                ['sample', 30, 200, 100, 400, 150, 250]
            ]
        }
    });

});

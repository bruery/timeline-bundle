/*
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamorw <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

c3.chart.internal.fn.isTimeSeries = function () {
    console.log('custom isTimeSeries');
    return false;
};
c3.chart.internal.fn.additionalConfig.test1 = undefined;
c3.chart.internal.fn.additionalConfig.test2 = undefined;

c3.chart.fn.hoge = function () {
    console.log("hoge()", this.internal.isTimeSeries());
};
c3.chart.fn.test = function () {
    console.log('test()', this.internal.config.test1);
};

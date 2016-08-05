/*
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamorw <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

describe('c3', function () {
    'use strict';

    var c3 = window.c3;

    it('exists', function () {
        expect(c3).not.toBeNull();
        expect(typeof c3).toBe('object');
    });
});

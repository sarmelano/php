<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            background: radial-gradient(circle, rgba(255, 255, 255, 1) 0%, rgba(171, 209, 234, 1) 100%);
        }
        .data {
            display: flex;
            height: 60px;
            justify-content: space-between;
            align-items: center;
            padding: 0 2.5vw;
        }
        .info {
            font-size: 26px;
            font-weight: 500;
        }
        .sign-out__brn {
            display: block;
            padding: 0.85vh 0.9vw;
            background-color: white;
            border-radius: 20px;
            font-size: 20px;
            font-weight: 500;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="data">
    <h1>Hello <?= Auth::getUser()->name; ?></h1>
    <p class="info">Click to clear</p>
    <a class="sign-out__brn" href="/signOut">Sign Out</a>
</div>
<canvas id="canvas"></canvas>

<!-- Click to clear the canvas -->
<script>
    // Draw Worm
    function DrawWorm() {
        var canvas, context, width, height, mouse = { x: window.innerWidth / 2, y: window.innerHeight };
        var interval, vms = [], MAX_NUM = 100, N = 80, px = window.innerWidth / 2, py = window.innerHeight;

        this.mouse = mouse;

        this.initialize = function() {
            canvas = document.getElementById("canvas");
            context = canvas.getContext('2d');
            width = window.innerWidth;
            height = window.innerHeight;
            canvas.width = width;
            canvas.height = height;

            canvas.addEventListener('touchmove', TouchMove, false);
            canvas.addEventListener('mousemove', MouseMove, false);
            canvas.addEventListener('click', MouseDown, false);

            interval = setInterval(Draw, 20);
        };

        var Draw = function() {
            var len = vms.length;
            for (var i = 0; i < len; i++) {
                var o = vms[i];
                if (o.count < N) {
                    DrawWormSegment(o);
                    o.count++;
                } else {
                    len--;
                    vms.splice(i, 1);
                    i--;
                }
            }
            Check();
        };

        var DrawWormSegment = function(obj) {
            if (Math.random() > 0.9) {
                obj.tmt.rotate(-obj.r * 2);
                obj.r *= -1;
            }

            obj.vmt.prependMatrix(obj.tmt);

            var cc1x = -obj.w * obj.vmt.c + obj.vmt.tx;
            var cc1y = -obj.w * obj.vmt.d + obj.vmt.ty;
            var pp1x = (obj.c1x + cc1x) / 2;
            var pp1y = (obj.c1y + cc1y) / 2;
            var cc2x = obj.w * obj.vmt.c + obj.vmt.tx;
            var cc2y = obj.w * obj.vmt.d + obj.vmt.ty;
            var pp2x = (obj.c2x + cc2x) / 2;
            var pp2y = (obj.c2y + cc2y) / 2;

            context.fillStyle = '#000000';
            context.beginPath();
            context.moveTo(obj.p1x, obj.p1y);
            context.quadraticCurveTo(obj.c1x, obj.c1y, pp1x, pp1y);
            context.lineTo(pp2x, pp2y);
            context.quadraticCurveTo(obj.c2x, obj.c2y, obj.p2x, obj.p2y);
            context.closePath();
            context.fill();

            obj.c1x = cc1x;
            obj.c1y = cc1y;
            obj.p1x = pp1x;
            obj.p1y = pp1y;
            obj.c2x = cc2x;
            obj.c2y = cc2y;
            obj.p2x = pp2x;
            obj.p2y = pp2y;
        };

        var Check = function() {
            var x0 = mouse.x, y0 = mouse.y;
            var vx = x0 - px, vy = y0 - py;
            var len = Math.min(Magnitude(vx, vy), 50);
            if (len < 10) return;

            var matrix = new Matrix2D();
            matrix.rotate(Math.atan2(vy, vx));
            matrix.translate(x0, y0);

            createWorm(matrix, len);

            context.beginPath();
            context.strokeStyle = '#000000';
            context.moveTo(px, py);
            context.lineTo(x0, y0);
            context.stroke();
            context.closePath();

            px = x0;
            py = y0;
        };

        var createWorm = function(mtx, len) {
            var angle = Math.random() * (Math.PI / 6 - Math.PI / 64) + Math.PI / 64;
            if (Math.random() > 0.5) angle *= -1;

            var tmt = new Matrix2D();
            tmt.scale(0.95, 0.95);
            tmt.rotate(angle);
            tmt.translate(len, 0);

            var w = 0.5;
            var obj = new Worm();

            obj.c1x = obj.p1x = -w * mtx.c + mtx.tx;
            obj.c1y = obj.p1y = -w * mtx.d + mtx.ty;
            obj.c2x = obj.p2x = w * mtx.c + mtx.tx;
            obj.c2y = obj.p2y = w * mtx.d + mtx.ty;

            obj.vmt = mtx;
            obj.tmt = tmt;
            obj.r = angle;
            obj.w = len / 20;
            obj.count = 0;

            vms.push(obj);
            if (vms.length > MAX_NUM) vms.shift();
        };

        var Worm = function() {
            this.c1x = this.c1y = this.c2x = this.c2y = this.p1x = this.p1y = this.p2x = this.p2y = null;
            this.w = this.r = this.count = null;
            this.vmt = this.tmt = null;
        };

        var MouseDown = function(e) {
            e.preventDefault();
            canvas.width = canvas.width;
            vms = [];
        };

        var MouseMove = function(e) {
            mouse.x = e.clientX - canvas.offsetLeft;
            mouse.y = e.clientY - canvas.offsetTop;
        };

        var TouchMove = function(e) {
            e.preventDefault();
            mouse.x = e.targetTouches[0].pageX - canvas.offsetLeft;
            mouse.y = e.targetTouches[0].pageY - canvas.offsetTop;
        };

        var Magnitude = function(x, y) {
            return Math.sqrt((x * x) + (y * y));
        };
    }

    (function(window) {
        var Matrix2D = function(a, b, c, d, tx, ty) {
            this.initialize(a, b, c, d, tx, ty);
        };
        var p = Matrix2D.prototype;

        Matrix2D.DEG_TO_RAD = Math.PI / 180;

        p.a = 1;
        p.b = 0;
        p.c = 0;
        p.d = 1;
        p.tx = 0;
        p.ty = 0;
        p.alpha = 1;
        p.shadow = null;
        p.compositeOperation = null;

        p.initialize = function(a, b, c, d, tx, ty) {
            if (a != null) this.a = a;
            this.b = b || 0;
            this.c = c || 0;
            if (d != null) this.d = d;
            this.tx = tx || 0;
            this.ty = ty || 0;
        };

        p.prepend = function(a, b, c, d, tx, ty) {
            var n11 = a * this.a + b * this.c;
            var n12 = a * this.b + b * this.d;
            var n21 = c * this.a + d * this.c;
            var n22 = c * this.b + d * this.d;
            var n31 = tx * this.a + ty * this.c + this.tx;
            var n32 = tx * this.b + ty * this.d + this.ty;

            this.a = n11;
            this.b = n12;
            this.c = n21;
            this.d = n22;
            this.tx = n31;
            this.ty = n32;
        };

        p.append = function(a, b, c, d, tx, ty) {
            var a1 = this.a;
            var b1 = this.b;
            var c1 = this.c;
            var d1 = this.d;

            this.a = a * a1 + b * c1;
            this.b = a * b1 + b * d1;
            this.c = c * a1 + d * c1;
            this.d = c * b1 + d * d1;
            this.tx = tx * a1 + ty * c1 + this.tx;
            this.ty = tx * b1 + ty * d1 + this.ty;
        };

        p.prependMatrix = function(matrix) {
            this.prepend(matrix.a, matrix.b, matrix.c, matrix.d, matrix.tx, matrix.ty);
        };

        p.appendMatrix = function(matrix) {
            this.append(matrix.a, matrix.b, matrix.c, matrix.d, matrix.tx, matrix.ty);
        };

        p.rotate = function(angle) {
            var cos = Math.cos(angle);
            var sin = Math.sin(angle);

            var a1 = this.a;
            var b1 = this.b;

            this.a = a1 * cos + this.c * sin;
            this.b = b1 * cos + this.d * sin;
            this.c = -a1 * sin + this.c * cos;
            this.d = -b1 * sin + this.d * cos;
        };

        p.skew = function(skewX, skewY) {
            skewX = skewX * Matrix2D.DEG_TO_RAD;
            skewY = skewY * Matrix2D.DEG_TO_RAD;
            this.append(Math.cos(skewY), Math.sin(skewY), -Math.sin(skewX), Math.cos(skewX), 0, 0);
        };

        p.scale = function(x, y) {
            this.a *= x;
            this.d *= y;
            this.tx *= x;
            this.ty *= y;
        };

        p.translate = function(x, y) {
            this.tx += x;
            this.ty += y;
        };

        p.identity = function() {
            this.a = this.d = 1;
            this.b = this.c = this.tx = this.ty = 0;
        };

        p.invert = function() {
            var a1 = this.a;
            var b1 = this.b;
            var c1 = this.c;
            var d1 = this.d;
            var tx1 = this.tx;
            var n = a1 * d1 - b1 * c1;

            this.a = d1 / n;
            this.b = -b1 / n;
            this.c = -c1 / n;
            this.d = a1 / n;
            this.tx = (c1 * this.ty - d1 * tx1) / n;
            this.ty = -(a1 * this.ty - b1 * tx1) / n;
        };

        p.isIdentity = function() {
            return this.tx === 0 && this.ty === 0 && this.a === 1 && this.b === 0 && this.c === 0 && this.d === 1;
        };

        p.decompose = function(target) {
            if (target == null) {
                target = {};
            }
            target.x = this.tx;
            target.y = this.ty;
            target.scaleX = Math.sqrt(this.a * this.a + this.b * this.b);
            target.scaleY = Math.sqrt(this.c * this.c + this.d * this.d);

            var skewX = Math.atan2(-this.c, this.d);
            var skewY = Math.atan2(this.b, this.a);

            if (skewX === skewY) {
                target.rotation = skewY / Matrix2D.DEG_TO_RAD;
                if (this.a < 0 && this.d >= 0) {
                    target.rotation += (target.rotation <= 0) ? 180 : -180;
                }
                target.skewX = target.skewY = 0;
            } else {
                target.skewX = skewX / Matrix2D.DEG_TO_RAD;
                target.skewY = skewY / Matrix2D.DEG_TO_RAD;
            }
            return target;
        };

        p.reinitialize = function(a, b, c, d, tx, ty) {
            this.initialize(a, b, c, d, tx, ty);
        };

        p.copy = function(matrix) {
            return this.reinitialize(matrix.a, matrix.b, matrix.c, matrix.d, matrix.tx, matrix.ty);
        };

        p.clone = function() {
            return new Matrix2D(this.a, this.b, this.c, this.d, this.tx, this.ty);
        };

        p.toString = function() {
            return `[Matrix2D (a=${this.a} b=${this.b} c=${this.c} d=${this.d} tx=${this.tx} ty=${this.ty})]`;
        };

        window.Matrix2D = Matrix2D;
    }(window));

    var worm = new DrawWorm();
    worm.initialize();
</script>
</body>
</html>
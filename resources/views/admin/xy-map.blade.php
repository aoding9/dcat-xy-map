<style>
    .map-container {
        position: relative;
        height: {{$height}};
        width: 100%;
        box-sizing: content-box;
    }

    .map-container .xy-bg {
        position: absolute;
        height: 100%;
        box-sizing: border-box;
    }

    .map-container .map-marker {
        position: absolute;
    }

    .map-container .map-marker img {
        width: 20px;
        height: 25px;
    }

    .input-group {
        align-items: center;
    }

</style>

<div class="{{$viewClass['form-group']}}">

    <label class="{{$viewClass['label']}} control-label">{!! $label !!}</label>

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')

        <div class="{{ $class }}">
            <div class="row mb-1">
                <div class="col-md-4">
                    <div class="input-group">
                        <label class="text-md mr-1">x:</label>
                        <input type="text" class="form-x form-control" name="{{ $name['x'] }}"
                               v-model="marker.x" {!! $attributes !!} />
                        <label class="text-md mx-1">y:</label>

                        <input type="text" class="form-y form-control" name="{{$name['y']}}"
                               v-model="marker.y" {!! $attributes !!} />
                    </div>
                </div>
            </div>

            <div class="map-container">
                <img class="xy-bg" src="{{$bg}}">

                <div class="map-marker" :style="{ top: `${marker.y}px`, left: `${marker.x}px` }"
                     v-on:mousedown="startDrag">
                    <img src="{{$marker}}">
                </div>
            </div>

        </div>


        @include('admin::form.help-block')
    </div>
</div>


<script init="{!! $selector !!}">

    var vm = new Vue({
        el: '{{$selector}}',
        data: {
            marker: {
                x: {{ $value['x'] }},
                y: {{ $value['y'] }},
            },
            bg: null,
            imgWidth: 0,
            imgHeight: 0,
        },
        mounted() {
            this.bg = document.getElementsByClassName('xy-bg')[0];
            this.imgWidth = this.bg.width - 20
            this.imgHeight = this.bg.height - 25
        },
        methods:
            {
                startDrag(event) {
                    console.log(event)
                    event.preventDefault();

                    let startX = event.clientX;
                    let startY = event.clientY;

                    let moveHandler = (event) => {
                        let deltaX = event.clientX - startX;
                        let deltaY = event.clientY - startY;

                        this.marker.x += deltaX;
                        this.marker.y += deltaY;

                        if (this.marker.x < 0) {
                            this.marker.x = 0
                        }
                        if (this.marker.y < 0) {
                            this.marker.y = 0
                        }
                        if (this.marker.x > this.imgWidth) {
                            this.marker.x = this.imgWidth
                        }
                        if (this.marker.y > this.imgHeight) {
                            this.marker.y = this.imgHeight
                        }

                        startX = event.clientX;
                        startY = event.clientY;
                    };

                    let upHandler = () => {
                        document.removeEventListener('mousemove', moveHandler);
                        document.removeEventListener('mouseup', upHandler);
                    };

                    document.addEventListener('mousemove', moveHandler);
                    document.addEventListener('mouseup', upHandler);
                }

            }
    })
</script>

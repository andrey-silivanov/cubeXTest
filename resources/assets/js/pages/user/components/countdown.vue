<template>
    <div class="countdown" :style="{height: windowHeight}">

        <!--<div class="block">
            <p class="digit">{{ days | twoDigits }}</p>
            <p class="text">Days</p>
        </div>-->
        <div class="block">
            <p class="digit">{{ hours | twoDigits }}</p>
            <p class="text">Hours</p>
        </div>
        <div class="block">
            <p class="digit">{{ minutes | twoDigits }}</p>
            <p class="text">Minutes</p>
        </div>
        <div class="block">
            <p class="digit">{{ seconds | twoDigits }}</p>
            <p class="text">Seconds</p>
        </div>
    </div>
</template>
<script type="text/babel">
    export default ({
        data: () => ({
            windowHeight: 0,
            now: Math.trunc((new Date()).getTime() / 1000)
        }),
        props: {
            date: {
                type: String
            }
        },
        created() {
            this.windowHeight = `${(window.innerHeight - 100)}px`
        },
        mounted() {
            window.setInterval(() => {
                this.now = Math.trunc((new Date()).getTime() / 1000);
            },1000);
        },
        computed: {
            dateInMilliseconds() {
                return Math.trunc(Date.parse(this.date) / 1000)
            },
            seconds() {
                return (this.dateInMilliseconds - this.now) % 60;
            },
            minutes() {
                return Math.trunc((this.dateInMilliseconds - this.now) / 60) % 60;
            },
            hours() {
                return Math.trunc((this.dateInMilliseconds - this.now) / 60 / 60) % 24;
            },
            days() {
                return Math.trunc((this.dateInMilliseconds - this.now) / 60 / 60 / 24);
            }
        },
        filters: {
            twoDigits(value) {
                if (value < 0) {
                    return '00';
                }
                if (value.toString().length <= 1) {
                    return `0${value}`;
                }
                return value;
            }
        }
    });

</script>
<style lang="scss" scoped>
    @import url(https://fonts.googleapis.com/css?family=Roboto+Condensed:400|Roboto:100);

    .countdown {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .block {
        display: flex;
        flex-direction: column;
        margin: 20px;
        justify-content: center;
    }

    .text {
        color: #00D788;
        font-size: 23px;
        font-family: 'Roboto Condensed', serif;
        font-weight: 40;
        margin-bottom: 10px;
        text-align: center;
    }

    .digit {
        color: #ecf0f1;
        font-size: 70px;
        font-weight: 100;
        font-family: 'Roboto', serif;
        margin: 10px;
        text-align: center;
    }
</style>
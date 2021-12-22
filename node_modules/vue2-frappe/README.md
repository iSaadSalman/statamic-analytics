# Vue 2 Frappe Charts

<p align="center">
    <a href="https://vuejs.org" target="_blank" rel="noopener noreferrer">
        <img width="100" src="https://vuejs.org/images/logo.png" alt="Vue logo">
    </a>
    <a href="https://frappe.github.io/charts" target="_blank" rel="noopener noreferrer">
        <img src="https://github.com/frappe/design/blob/master/logos/charts-logo.svg" height="128">
    </a>
</p>


[![npm version](https://badge.fury.io/js/vue2-frappe.svg)](https://badge.fury.io/js/vue2-frappe)

This is a simple package to get using Frappe Charts within VueJS

## How to use

First we need to import and initialize

```es6
import Vue from 'vue'
import Chart from 'vue2-frappe'

Vue.use(Chart)
```

or use the component directly

```es6
import { VueFrappe } from 'vue2-frappe'

export default {
  components: {
    VueFrappe,
  },
};
```

Then in our Vue templates:

```html
<template>
    <vue-frappe
            id="test"
            :labels="[
                '12am-3am', '3am-6am', '6am-9am', '9am-12pm',
                '12pm-3pm', '3pm-6pm', '6pm-9pm', '9pm-12am'
            ]"
            title="My Awesome Chart"
            type="axis-mixed"
            :height="300"
            :colors="['purple', '#ffa3ef', 'light-blue']"
            :dataSets="this.data">
        </vue-frappe>
</template>
<script>
    export default {
        data () {
            return {
                data: [{
                    name: "Some Data", chartType: 'bar',
                    values: [25, 40, 30, 35, 8, 52, 17, -4]
                },
                {
                    name: "Another Set", chartType: 'bar',
                    values: [25, 50, -10, 15, 18, 32, 27, 14]
                },
                {
                    name: "Yet Another", chartType: 'line',
                    values: [15, 20, -3, -15, 58, 12, -17, 37]
                }]
            }
        }
    }
</script>
```

### Links

[Frappe Charts](https://github.com/frappe/charts)

[Vue JS](https://vuejs.org/)

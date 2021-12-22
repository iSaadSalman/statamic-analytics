<template>
    <div>
        <div class="flex items-center justify-between mb-3">
            <h1>Analytics</h1>

            <div class="flex items-center">
                <span class="font-medium text-sm mr-2">Range:</span>

                <select v-model="range" class="bg-white p-1 rounded-lg">
                    <option value="today">Today</option>
                    <option value="1_week">7 Days</option>
                    <option value="30_days">30 Days</option>
                    <option value="6_months">6 Months</option>
                    <option value="12_months">12 Months</option>
                </select>
            </div>
        </div>

        <VisitorOverview :period="range" :graph-color="graphColor" />

        <TopPages :period="range" />

        <div class="flex -mx-2 mt-3">
            <TopReferrers class="mx-2 w-1/2" :period="range" />
            <TopBrowser class="mx-2 w-1/2" :period="range" />
        </div>
        
        <TopCountries class="mt-3" :period="range"/>
    </div>
</template>

<script>
import TopBrowser from "./TopBrowser";
import TopCountries from "./TopCountries";
import TopReferrers from "./TopReferrers";
import TopPages from "./TopPages";
import VisitorOverview from "./VisitorOverview";

export default {
    components: {
        VisitorOverview,
        TopReferrers,
        TopBrowser,
        TopCountries,
        TopPages
    },

    data() {
        return {
            range: '1_week'
        }
    }
}
</script>

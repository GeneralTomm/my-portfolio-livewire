<div class="grids-1" @click.away="sidebar = !sidebar">
    <div class="grids">
        <span class="span-notication">Getting Started</span>
        <button :class="side==='introduction' ? aktif : tidak" @click="side = 'introduction'">
            Introduction
        </button>
        <button :class="side==='quick-start' ? aktif : tidak" @click="side = 'quick-start'">
            Quick Start
        </button>
        <button :class="side==='customize' ? aktif : tidak" @click="side = 'customize'">
            Customize
        </button>
        <button :class="side==='setup-framework' ? aktif : tidak" @click="side = 'setup-framework'">
            Setup Framework
        </button>
    </div>
    <div class="grids">
        <span class="span-notication">Components</span>
        <button :class="side==='badge' ? aktif : tidak" @click="side = 'badge'">
            Badge
        </button>
        <button :class="side==='alert' ? aktif : tidak" @click="side = 'alert'">
            Alert
        </button>
        <button :class="side==='card' ? aktif : tidak" @click="side = 'card'">
            Card
        </button>
        <button :class="side==='button' ? aktif : tidak" @click="side = 'button'">
            Button
        </button>
        <button :class="side==='accordion' ? aktif : tidak" @click="side = 'accordion'">
            Accordion
        </button>
        <button :class="side==='dropdown' ? aktif : tidak" @click="side = 'dropdown'">
            Dropdown
        </button>
        <button :class="side==='tabs' ? aktif : tidak" @click="side = 'tabs'">
            Tabs
        </button>
        <button :class="side==='toast' ? aktif : tidak" @click="side = 'toast'">
            Toast
        </button>
        <button :class="side==='tooltip' ? aktif : tidak" @click="side = 'tooltip'">
            Tooltip
        </button>
    </div>
</div>

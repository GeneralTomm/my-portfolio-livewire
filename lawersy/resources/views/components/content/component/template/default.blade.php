<div class="py-5">
    <div class="bg-white rounded-md" x-data="{previews : 'preview',
                    menuTabs : 'active-menu',
                    menuTabsNon : 'hover-active-menu'}">
        <div class="border-table">
            <span class="border-table-span">Default</span>
            <div class="flex lg:gap-4 gap-2 p-2">
                <button :class="previews==='preview' ? menuTabs : menuTabsNon" @click="previews = 'preview'">
                    Result
                </button>
                <button :class="previews==='code' ? menuTabs : menuTabsNon" @click="previews = 'code'">
                    Code
                </button>
            </div>
        </div>
        <div>
            <div x-show="previews === 'preview'" class="p-4">
                <div class="overflow-y-auto">
                    @include('components.content.component.badge.result.default')
                </div>
            </div>
            <div x-show="previews === 'code'" class="p-4">
                <pre class="language-html dark:text-black overflow-y-scroll"><code>@include('components.content.component.badge.code.default')</code></pre>
            </div>
        </div>

    </div>
</div>

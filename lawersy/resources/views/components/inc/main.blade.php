<div class="flex flex-col">
    <div x-show="side == 'introduction'">
        @include('components.content.introduction')
    </div>
    <div x-show="side == 'quick-start'">
        @include('components.content.quick')
    </div>
    <div x-show="side == 'customize'">
        @include('components.content.customize')
        <!-- <include src="inc/getting/customize.html"></include> -->
    </div>
    <div x-show="side == 'setup-framework'">
        @include('components.content.setup')
    </div>
    <div x-show="side == 'badge'">
        @include('components.content.component.badge')
    </div>
    <div x-show="side == 'alert'">
        <include src="inc/components/alert.html"></include>
    </div>
    <div x-show="side == 'button'">
    </div>
</div>


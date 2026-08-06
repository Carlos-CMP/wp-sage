<header class="border-b border-border">
  <div class="mx-auto flex max-w-5xl items-center justify-between px-4 py-5 sm:px-6">
    <a
      class="text-base font-semibold tracking-tight text-ink no-underline hover:text-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent focus-visible:outline-offset-[3px] focus-visible:rounded-[2px]"
      href="{{ home_url('/') }}"
    >
      {!! $siteName !!}
    </a>

    @if (has_nav_menu('primary_navigation'))
      <nav
        class="[&_ul]:m-0 [&_ul]:flex [&_ul]:list-none [&_ul]:gap-6 [&_ul]:p-0 [&_a]:text-sm [&_a]:text-ink-muted [&_a]:no-underline hover:[&_a]:text-ink"
        aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}"
      >
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'echo' => false]) !!}
      </nav>
    @endif
  </div>
</header>

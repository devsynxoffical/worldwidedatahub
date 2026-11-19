/* WWDH data landing pages: tabs, industry filter, reveal, sticky CTA, lead attribution */
(function () {
  'use strict';
  var root = document.querySelector('.lp-page');
  if (!root) return;

  // Tabs (sample data preview)
  root.querySelectorAll('[data-lp-tabs]').forEach(function (group) {
    var tabs = group.querySelectorAll('.lp-tab');
    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        tabs.forEach(function (t) { t.setAttribute('aria-selected', 'false'); });
        tab.setAttribute('aria-selected', 'true');
        var id = tab.getAttribute('aria-controls');
        group.parentNode.querySelectorAll('.lp-panel').forEach(function (p) {
          p.classList.toggle('is-active', p.id === id);
        });
      });
    });
  });

  // Industry filter chips
  root.querySelectorAll('[data-lp-filter]').forEach(function (bar) {
    var grid = document.getElementById(bar.getAttribute('data-lp-filter'));
    if (!grid) return;
    bar.querySelectorAll('.lp-chip').forEach(function (chip) {
      chip.addEventListener('click', function () {
        bar.querySelectorAll('.lp-chip').forEach(function (c) { c.classList.remove('is-active'); });
        chip.classList.add('is-active');
        var f = chip.getAttribute('data-filter');
        grid.querySelectorAll('.lp-ind-item').forEach(function (it) {
          var show = f === 'all' || (' ' + it.getAttribute('data-group') + ' ').indexOf(' ' + f + ' ') > -1;
          it.classList.toggle('is-hidden', !show);
        });
      });
    });
  });

  // Reveal on scroll
  var items = root.querySelectorAll('.lp-reveal');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); }
      });
    }, { threshold: 0.12 });
    items.forEach(function (el) { io.observe(el); });
  } else {
    items.forEach(function (el) { el.classList.add('is-in'); });
  }

  // Sticky mobile CTA after the hero
  var sticky = root.querySelector('.lp-sticky');
  var hero = root.querySelector('.lp-hero');
  if (sticky && hero) {
    var onScroll = function () {
      sticky.classList.toggle('is-visible', window.scrollY > hero.offsetHeight * 0.8);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // Lead attribution: referrer + UTM params into the form
  var params = new URLSearchParams(window.location.search);
  var utm = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'gclid']
    .filter(function (k) { return params.get(k); })
    .map(function (k) { return k + '=' + params.get(k); }).join('&');
  root.querySelectorAll('.lp-form').forEach(function (form) {
    var r = form.querySelector('.lp-ref'); if (r) r.value = document.referrer || 'direct';
    var u = form.querySelector('.lp-utm'); if (u) u.value = utm;
    form.addEventListener('submit', function () {
      var b = form.querySelector('button[type=submit]');
      if (b) { b.disabled = true; b.textContent = 'Sending…'; }
      if (window.dataLayer) window.dataLayer.push({ event: 'generate_lead', form: 'wwdh_landing' });
    });
  });

  // Track the GA4 lead event after a successful redirect
  if (params.get('lead') === 'ok' && window.dataLayer) {
    window.dataLayer.push({ event: 'lead_confirmed' });
  }
})();

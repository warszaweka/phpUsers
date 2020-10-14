const pagePathActive = document.querySelector("#pathActive");
const title = document.querySelector("#title");
const clicksGraphSVGPath = document.querySelector("#clicksGraph svg path");
const viewsGraphSVGPath = document.querySelector("#viewsGraph svg path");

const SVGWidth = 1180;
const SVGHeight = 250;

const user = location.pathname.split("/")[3].split("?")[0];

async function get_user_stat(from, to, user) {
  const response = await fetch(`/users/_user.php/${user}?from=${from.toISOString().slice(0, 10)}&to=${to.toISOString().slice(0, 10)}`);
  return await response.json();
}

async function update_user_stat(from, to) {
  const data = await get_user_stat(from, to, user);
  pagePathActive.innerHTML = title.firstElementChild.innerHTML = `${data.first_name} ${data.last_name}`;
  let maxClicks = 0;
  let maxViews = 0;
  for (let stat of data.stats) {
    if (stat.clicks > maxClicks) {
      maxClicks = stat.clicks;
    }
    if (stat.page_views > maxViews) {
      maxViews = stat.page_views;
    }
  }
  const clicksRatio = SVGHeight / (+maxClicks + 1);
  const viewsRatio = SVGHeight / (+maxViews + 1);
  const dateAmount = (to - from) / (1000 * 60 * 60 * 24) + 1;
  const dateRatio = SVGWidth / (dateAmount + 1); 
  let clicksD = "M";
  let viewsD = "M";
  for (let i = 0, j = 0, k = new Date(+from); i < dateAmount; ++i, k.setUTCDate(k.getUTCDate() + 1)) {
    const l = Math.round((i + 1) * dateRatio);
    if (data.stats[j].date === k.toISOString().slice(0, 10)) {
      clicksD += ` ${l},${Math.round(SVGHeight - data.stats[j].clicks * clicksRatio)}`;
      viewsD += ` ${l},${Math.round(SVGHeight - data.stats[j].page_views * viewsRatio)}`;
      ++j;
    } else {
      clicksD += ` ${l},${SVGHeight}`;
      viewsD += ` ${l},${SVGHeight}`;
    }
    if (i === 0) {
      clicksD += " L";
      viewsD += " L";
    }
  }
  clicksGraphSVGPath.setAttribute("d", clicksD);
  viewsGraphSVGPath.setAttribute("d", viewsD);
}

/*
const today = new Date();
const weekAgo = new Date();
weekAgo.setDate(weekAgo.getDate() - 7);
*/
const weekAgo = new Date(Date.UTC(2019, 9, 7));
const today = new Date(Date.UTC(2019, 9, 30));

update_user_stat(weekAgo, today);

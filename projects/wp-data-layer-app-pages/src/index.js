import domReady from "@wordpress/dom-ready";
import { createRoot, useEffect } from "@wordpress/element";
import { useSelect, useRegistry } from "@wordpress/data";
import { store as coreDataStore } from "@wordpress/core-data";

import "./style.scss";

function App() {
  const registry = useRegistry();

  useEffect(() => {
    console.log(registry);
    Object.keys(registry.namespaces["core"].selectors).forEach(
      (propertyName) => {
        if (propertyName in registry.namespaces["core"].resolvers) {
          console.log(`${propertyName} has a resolver`);
        }
      }
    );
  }, []);

  const pages = useSelect(
    (select) =>
      select(coreDataStore).getEntityRecords("postType", "page", {
        per_page: 2,
      }),
    []
  );
  return <PagesList pages={pages} />;
}

function PagesList({ pages }) {
  return (
    <ul>
      {pages?.map((page) => (
        <li key={page.id}>{page.title.rendered}</li>
      ))}
    </ul>
  );
}

domReady(() => {
  const root = createRoot(document.getElementById("wp-data-layer-app-pages"));
  root.render(<App />);
});

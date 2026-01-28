import { useSelect } from "@wordpress/data";
import { store as coreDataStore } from "@wordpress/core-data";
import { PagesList } from "./PagesList";
import { SearchControl } from "@wordpress/components";
import { useState } from "@wordpress/element";
import { ButtonCreatePage } from "./ButtonCreatePage";
import { Notifications } from "./Notifications";

export const App = () => {
  const [searchTerm, setSearchTerm] = useState("");
  const { hasResolved, pages } = useSelect(
    (select) => {
      const query = {};
      if (searchTerm) {
        query.search = searchTerm;
      }
      const selectorArgs = ["postType", "page", query];
      return {
        pages: select(coreDataStore).getEntityRecords(
          "postType",
          "page",
          query
        ),
        hasResolved: select(coreDataStore).hasFinishedResolution(
          "getEntityRecords",
          selectorArgs
        ),
      };
    },
    [searchTerm]
  );
  return (
    <div>
      <div>
        <div className="list-controls">
          <SearchControl onChange={setSearchTerm} value={searchTerm} />
          <ButtonCreatePage />
        </div>
        <PagesList hasResolved={hasResolved} pages={pages} />
        <Notifications />
      </div>
    </div>
  );
};

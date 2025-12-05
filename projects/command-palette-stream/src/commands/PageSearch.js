import { useSelect } from "@wordpress/data";
import { useCommandLoader } from "@wordpress/commands";
import { post, page, layout, symbolFilled } from "@wordpress/icons";
import { registerPlugin } from "@wordpress/plugins";
import { store as coreStore } from "@wordpress/core-data";
import { useMemo } from "@wordpress/element";

const icons = {
  post,
  page,
  wp_template: layout,
  wp_template_part: symbolFilled,
};

export default function PageSearch() {
  console.log("🔍 PageSearch...");
  registerPlugin("dev-blog-command-palette", {
    render: () => {
      console.log("🔍 Rendering PageSearch plugin...");
      function usePageSearchCommandLoader({ search }) {
        console.log(`🔍 Searching for page: ${search}`);

        // Retrieve the pages for the "search" term.
        const { records, isLoading } = useSelect(
          (select) => {
            console.log("🔍 Selecting records...");
            const { getEntityRecords } = select(coreStore);
            const query = {
              search: !!search ? search : undefined,
              per_page: 10,
              orderby: search ? "relevance" : "date",
            };
            return {
              records: getEntityRecords("postType", "page", query),
              isLoading: !select(coreStore).hasFinishedResolution(
                "getEntityRecords",
                "postType",
                "page",
                query
              ),
            };
          },
          [search]
        );

        // Create the commands.
        const commands = useMemo(() => {
          console.log("🔍 Creating commands...");
          return (records ?? []).slice(0, 10).map((record) => {
            return {
              name: record.title?.rendered + " " + record.id,
              label: record.title?.rendered
                ? record.title?.rendered
                : __("(no title)"),
              icon: icons[postType],
              callback: ({ close }) => {
                const args = {
                  postType,
                  postId: record.id,
                  ...extraArgs,
                };
                document.location = addQueryArgs("site-editor.php", args);
                close();
              },
            };
          });
        }, [records, history]);

        return {
          commands,
          isLoading,
        };
      }

      useCommandLoader({
        name: "myplugin/page-search",
        hook: usePageSearchCommandLoader,
      });
    },
  });
}

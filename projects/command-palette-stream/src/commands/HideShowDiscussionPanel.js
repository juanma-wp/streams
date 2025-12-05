import { store, useCommand } from "@wordpress/commands";
import { dispatch, useDispatch, useSelect } from "@wordpress/data";
import { __ } from "@wordpress/i18n";
import { settings, search, comment, button } from "@wordpress/icons";
import { registerPlugin } from "@wordpress/plugins";

export default function HideShowDiscussionPanel() {
  registerPlugin("dev-blog-command-palette", {
    render: () => {
      // Determine if the discussion panel is enabled.
      const discussionPanelEnabled = useSelect((select) => {
        return select("core/edit-post").isEditorPanelEnabled(
          "discussion-panel"
        );
      }, []);

      // Get functions for toggling panels and creating snackbars.
      const { toggleEditorPanelEnabled } = useDispatch("core/edit-post");
      const { createInfoNotice } = useDispatch("core/notices");

      // Register command to toggle discussion panel.
      useCommand({
        name: "dev-blog/discussion-show-hide",
        label: discussionPanelEnabled
          ? __("Hide discussion panel", "dev-blog")
          : __("Show discussion panel", "dev-blog"),
        icon: comment,
        callback: ({ close }) => {
          // Toggle the discussion panel.
          toggleEditorPanelEnabled("discussion-panel");

          // Add a snackbar notice.
          createInfoNotice(
            discussionPanelEnabled
              ? __("Discussion panel hidden.", "dev-blog")
              : __("Discussion panel displayed.", "dev-blog"),
            {
              id: "dev-blog/toggle-discussion/notice",
              type: "snackbar",
            }
          );

          close();
        },
      });
    },
  });
}

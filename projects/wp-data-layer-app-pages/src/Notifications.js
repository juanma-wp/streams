import { useSelect, useDispatch } from "@wordpress/data";
import { store as noticesStore } from "@wordpress/notices";
import { SnackbarList } from "@wordpress/components";

export const Notifications = () => {
  const notices = useSelect((select) => select(noticesStore).getNotices(), []);
  const { removeNotice } = useDispatch(noticesStore);
  const snackbarNotices = notices.filter(({ type }) => type === "snackbar");

  return (
    <SnackbarList
      notices={snackbarNotices}
      className="components-editor-notices__snackbar"
      onRemove={removeNotice}
    />
  );
};

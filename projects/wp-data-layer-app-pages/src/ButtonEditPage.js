import { useState } from "@wordpress/element";
import { Button, Modal } from "@wordpress/components";
import { PageFormEdit } from "./PageFormEdit";

const ButtonEditPage = ({ pageId }) => {
  const [isOpen, setOpen] = useState(false);
  const openModal = () => setOpen(true);
  const closeModal = () => setOpen(false);

  return (
    <>
      <Button onClick={openModal} variant="primary">
        Edit
      </Button>
      {isOpen && (
        <Modal onRequestClose={closeModal} title="Edit page">
          <PageFormEdit
            pageId={pageId}
            onCancel={closeModal}
            onSaveFinished={closeModal}
          />
        </Modal>
      )}
    </>
  );
};

export { ButtonEditPage };

import { Button, Modal } from "@wordpress/components";
import { useState } from "@wordpress/element";
import { PageFormCreate } from "./PageFormCreate";

function ButtonCreatePage() {
  const [isOpen, setOpen] = useState(false);
  const openModal = () => setOpen(true);
  const closeModal = () => setOpen(false);
  return (
    <>
      <Button onClick={openModal} variant="primary">
        Create a new Page
      </Button>
      {isOpen && (
        <Modal onRequestClose={closeModal} title="Create a new page">
          <PageFormCreate onCancel={closeModal} onSaveFinished={closeModal} />
        </Modal>
      )}
    </>
  );
}

export { ButtonCreatePage };

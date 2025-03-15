# 2025-03-14 WordPress Data Layer (part 2)

[![](./thumbnail.png)](https://youtu.be/18zDV5KIDog)

- https://learn.wordpress.org/course/using-the-wordpress-data-layer/
- https://excalidraw.com/#json=TOA3xKqxY4ygaoND_Atbw,9LsoKdiqhU79pUbjBzP04Q
- https://developer.wordpress.org/block-editor/reference-guides/data/

---

> [!TIP]
> To check which selector have a related resolver we can use the following code.

```js
const registry = useRegistry();

useEffect(() => {
  console.log(registry);
  Object.keys(registry.namespaces["core"].selectors).forEach((propertyName) => {
    if (propertyName in registry.namespaces["core"].resolvers) {
      console.log(`${propertyName} has a resolver`);
    }
  });
}, []);
```

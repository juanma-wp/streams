# 2025-03-14 WordPress Data Layer (part 2)

[![](./thumbnail.png)](https://www.youtube.com/watch?v=GlowE1b11Jk)

🎥 **Watch this session on YouTube:** [WordPress Data Layer (part 2)](https://www.youtube.com/watch?v=GlowE1b11Jk)

- https://learn.wordpress.org/course/using-the-wordpress-data-layer/
- https://excalidraw.com/#json=TOA3xKqxY4ygaoND_Atbw,9LsoKdiqhU79pUbjBzP04Q
- https://developer.wordpress.org/block-editor/reference-guides/data/

Code of project worked in the session is available at:
https://github.com/juanma-wp/streams/tree/main/projects/2025/wp-data-layer-app-pages

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

# Hover Product Image Swap

**Version :** 3.0  
**Auteur :** Troteseil Lucas  
**Compatibilité :** WordPress + WooCommerce  

---

## 🧩 Description

**Hover Product Image Swap** est un plugin WordPress conçu pour les boutiques WooCommerce. Il permet d'afficher une image secondaire d’un produit au **survol de la souris**, offrant ainsi une expérience utilisateur plus dynamique et immersive.

L'effet ne s'applique **que sur les appareils desktop** (pas de hover sur mobile) et peut être **activé/désactivé** via une **interface dédiée dans le menu d’administration WordPress**.

---

## ✨ Fonctionnalités

- Affiche automatiquement la première image de la galerie du produit au survol.
- S’applique uniquement sur ordinateur (pas sur mobile).
- Activation simple via un menu WordPress (`Hover Image`).
- Aucun réglage technique nécessaire.
- Léger et optimisé : le CSS est injecté uniquement si l’option est activée.

---

## 📦 Installation

1. Téléchargez ou clonez ce plugin dans le dossier `wp-content/plugins`.
2. Activez le plugin dans le menu **Extensions** de WordPress.
3. Accédez au menu **Hover Image** dans l’admin WordPress.
4. Cochez l’option `Activer l’effet de survol`.
5. Assurez-vous que vos produits WooCommerce ont une **image principale** et au moins **une image dans la galerie**.

---

## 🛠 Utilisation

Le plugin injecte automatiquement le HTML et CSS nécessaires pour afficher la deuxième image lors du survol, **sans modification de thème requise**.

### Exemple d'effet visuel :
- 🖼️ Image principale visible par défaut.
- 🖱️ Au survol : la première image de la galerie apparaît à la place.

---

## 🔒 Restrictions

- Ne fonctionne **pas sur mobile** (détecté avec `wp_is_mobile()`).
- Ne remplace pas les images produits dans les pages individuelles (uniquement sur les pages de **listing**).

---

## 📁 Arborescence


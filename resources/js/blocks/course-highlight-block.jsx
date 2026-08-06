import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, RangeControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import ServerSideRender from '@wordpress/server-side-render';

registerBlockType('novicell/course-highlight', {
  title: __('Destacado de cursos', 'sage'),
  description: __('Muestra un título y una lista de los cursos más recientes.', 'sage'),
  category: 'novicell',
  icon: 'welcome-learn-more',

  // Esquema de datos del bloque. Debe coincidir con el 'attributes' que
  // declaramos en PHP (register_block_type) porque WordPress guarda estos
  // valores serializados dentro del post_content, y PHP los vuelve a leer
  // desde ahí cuando renderiza el bloque en el frontend.
  attributes: {
    title: {
      type: 'string',
      default: 'Nuestros cursos',
    },
    numberOfCourses: {
      type: 'number',
      default: 3,
    },
  },

  // edit() dibuja lo que ve el editor en wp-admin. No es el HTML final del
  // frontend: aquí solo montamos los controles (panel lateral) y delegamos
  // la vista previa del contenido a ServerSideRender, que le pide a PHP
  // (el mismo render_callback que se usará en el frontend) que devuelva el
  // HTML ya renderizado con los atributos actuales.
  edit: ({ attributes, setAttributes }) => {
    const { title, numberOfCourses } = attributes;
    const blockProps = useBlockProps();

    return (
      <div {...blockProps}>
        <InspectorControls>
          <PanelBody title={__('Ajustes del bloque', 'sage')}>
            <TextControl
              label={__('Título', 'sage')}
              value={title}
              onChange={(value) => setAttributes({ title: value })}
            />
            <RangeControl
              label={__('Número de cursos', 'sage')}
              value={numberOfCourses}
              onChange={(value) => setAttributes({ numberOfCourses: value })}
              min={1}
              max={6}
            />
          </PanelBody>
        </InspectorControls>

        <ServerSideRender
          block="novicell/course-highlight"
          attributes={attributes}
        />
      </div>
    );
  },

  // save() solo aplica a bloques "estáticos", donde WordPress guarda el
  // HTML directamente en post_content. Este es un bloque "dinámico"
  // (tiene render_callback en PHP), así que save() no pinta nada: el
  // frontend siempre se genera en PHP, en el momento de la petición.
  save: () => null,
});

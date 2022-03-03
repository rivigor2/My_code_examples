package io.vrnext.dbcore.entities.catalogues;

import java.io.Serializable;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author riv
 */

@Entity
@Table(name = "_catalogues_groups")
public class _catalogues_groups implements Serializable {
    
    @Id
    @Column(name = "uniq")
    private String uniq;
    
    @Column(name = "member_uniq")    
    private String member_uniq;
    
    @Column(name = "date_modified")
    private Integer    date_modified;
    
    @Column(name = "date_deleted")
    private Integer    date_deleted;
    
    @Column(name = "catalogue_uid")
    private Integer    catalogue_uid;
    
    @Column(name = "product_type")
    private Integer    product_type;
    
    @Column(name = "hierarchy_uniq")
    private String hierarchy_uniq;

    public String getUniq() {
        return uniq;
    }

    public void setUniq(String uniq) {
        this.uniq = uniq;
    }

    public String getMember_uniq() {
        return member_uniq;
    }

    public void setMember_uniq(String member_uniq) {
        this.member_uniq = member_uniq;
    }

    public Integer getDate_modified() {
        return date_modified;
    }

    public void setDate_modified(Integer date_modified) {
        this.date_modified = date_modified;
    }

    public Integer getDate_deleted() {
        return date_deleted;
    }

    public void setDate_deleted(Integer date_deleted) {
        this.date_deleted = date_deleted;
    }

    public Integer getCatalogue_uid() {
        return catalogue_uid;
    }

    public void setCatalogue_uid(Integer catalogue_uid) {
        this.catalogue_uid = catalogue_uid;
    }

    public Integer getProduct_type() {
        return product_type;
    }

    public void setProduct_type(Integer product_type) {
        this.product_type = product_type;
    }

    public String getHierarchy_uniq() {
        return hierarchy_uniq;
    }

    public void setHierarchy_uniq(String hierarchy_uniq) {
        this.hierarchy_uniq = hierarchy_uniq;
    }

  
    
    
}
